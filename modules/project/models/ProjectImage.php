<?php

namespace app\modules\project\models;

use app\modules\admin\traits\QueryExceptions;
use PHPThumb\GD;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property integer $project_id
 * @property string $image
 * @property string $image_hash
 * @property string $position
 *
 * @property Project $project
 *
 * @mixin PositionBehavior
 * @mixin ImageUploadBehavior
 */
class ProjectImage extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['project_id'],
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
                'filePath' => '@webroot/uploads/project_image/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl' => '/uploads/project_image/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/project_image/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
                'thumbUrl' => '/uploads/cache/project_image/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'project_images';
    }

    public function rules()
    {
        return [
            ['project_id', 'required'],
            ['project_id', 'integer'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'jpeg'], 'checkExtensionByMimeType' => false],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Товар',
            'image' => 'Изображение',
        ];
    }

    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->image instanceof UploadedFile) {
            $this->image_hash = uniqid();
        }
        return parent::beforeSave($insert);
    }
}
