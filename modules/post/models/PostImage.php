<?php

namespace app\modules\post\models;

use app\modules\admin\traits\QueryExceptions;
use PHPThumb\GD;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property integer $post_id
 * @property string $image
 * @property string $image_hash
 * @property string $position
 *
 * @property Post $post
 *
 * @mixin PositionBehavior
 * @mixin ImageUploadBehavior
 */
class PostImage extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['post_id'],
            ],
            [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['processor' => function (GD $thumb) {
                        $thumb->resize(570, 430);
                    }],
                ],
                'filePath' => '@webroot/uploads/post_image/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl' => '/uploads/post_image/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/post_image/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
                'thumbUrl' => '/uploads/cache/post_image/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'post_images';
    }

    public function rules()
    {
        return [
            ['post_id', 'required'],
            ['post_id', 'integer'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'jpeg'], 'checkExtensionByMimeType' => false],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Товар',
            'image' => 'Изображение',
        ];
    }

    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->image instanceof UploadedFile) {
            $this->image_hash = uniqid();
        }
        return parent::beforeSave($insert);
    }
}
