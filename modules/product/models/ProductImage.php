<?php

namespace app\modules\product\models;

use app\modules\admin\traits\QueryExceptions;
use PHPThumb\GD;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property string $image_hash
 * @property string $position
 *
 * @property Product $product
 *
 * @mixin PositionBehavior
 * @mixin ImageUploadBehavior
 */
class ProductImage extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['product_id'],
            ],
            [
                'class' => ImageUploadBehavior::class,
                'createThumbsOnRequest' => true,
                'attribute' => 'image',
                'thumbs' => [
                    'icon' => ['height' => 68, 'width' => 68],
                    'thumb' => ['height' => 470, 'width' => 426],
                    'origin' => ['processor' => function (GD $thumb) {
                        $thumb->resize(1024, 768);
                    }],
                ],
                'filePath' => '@webroot/uploads/product_image/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl' => '/uploads/product_image/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/product_image/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
                'thumbUrl' => '/uploads/cache/product_image/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
            ],
        ];
    }

    public static function tableName()
    {
        return 'product_image';
    }

    public function rules()
    {
        return [
            ['product_id', 'required'],
            ['product_id', 'integer'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'jpeg'], 'checkExtensionByMimeType' => false],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Товар',
            'image' => 'Изображение',
        ];
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->image instanceof UploadedFile) {
            $this->image_hash = uniqid();
        }
        return parent::beforeSave($insert);
    }
}
