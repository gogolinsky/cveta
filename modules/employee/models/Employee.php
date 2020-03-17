<?php

namespace app\modules\employee\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $post
 * @property string $image
 * @property string $description
 * @property string $content
 *
 * @mixin ImageUploadBehavior
 * @mixin PositionBehavior
 */
class Employee extends ActiveRecord
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
                    'thumb' => ['width' => 370, 'height' => 419],
                ],
                'filePath' => '@webroot/uploads/employee/image_[[pk]].[[extension]]',
                'fileUrl' => '/uploads/employee/image_[[pk]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/employee/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/uploads/cache/employee/image_[[md5_attribute_image]]_[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'employees';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['content', 'string'],
            [['title', 'description', 'post'], 'string', 'max' => 255],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'title' => 'Имя',
            'post' => 'Должность',
            'image' => 'Прикрепить изображение',
            'description' => 'Краткое описание',
            'content' => 'Контент',
        ];
    }

    public function getHref()
    {
        return Url::to(['/employee/frontend/view', 'id' => $this->id]);
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