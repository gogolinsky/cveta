<?php

namespace app\modules\cert\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "certs".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $image
 *
 * @mixin ImageUploadBehavior
 * @mixin PositionBehavior
 */
class Cert extends ActiveRecord
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
                    'thumb' => ['width' => 210, 'height' => 219],
                ],
                'filePath' => '@webroot/uploads/cert/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/cert/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/cert/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/cert/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'certs';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 255],
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
