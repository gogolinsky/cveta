<?php

namespace app\modules\product\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * This is the model class for table "products_files".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property float $volume
 * @property float $price
 * @property int $position
 * @property int $product_id
 *
 * @property Product $product
 *
 * @mixin PositionBehavior
 */
class Variation extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            PositionBehavior::class,
        ];
    }

    public static function tableName()
    {
        return 'product_variations';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['price', 'volume'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'volume' => 'Объем, л.',
            'price' => 'Цена',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price ?? $this->product->getPrice();
    }
}
