<?php

namespace app\modules\slider\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $link
 *
 * @mixin ImageUploadBehavior
 * @mixin PositionBehavior
 */
class Slide extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            PositionBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 1920, 'height' => 1080],
                ],
                'filePath' => '@webroot/uploads/slider/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/slider/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/slider/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/slider/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'slider';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            [['title', 'description'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 500],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'link' => 'Ссылка',
            'image' => 'Прикрепить изображение',
            'images' => 'Фото',
        ];
    }

    public function hasImage()
    {
        return !empty($this->image) && file_exists($this->getUploadedFilePath('image'));
    }

    public function deleteImage()
    {
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $this->getBehavior('image');
        $imageBehavior->cleanFiles();
        $this->updateAttributes(['image' => null]);
    }

    public function getTitle()
    {
        return $this->title;
    }
}
