<?php

namespace app\modules\eav\models;

use app\modules\product\models\Product;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%eav_attribute_value}}".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $product_id
 * @property integer $attribute_id
 * @property string $value
 * @property integer $option_id
 *
 * @property EavAttribute $eavAttribute
 * @property EavAttributeOption $option
 */
class EavAttributeValue extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%eav_attribute_value}}';
    }

    public function rules()
    {
        return [
            [['entity_id', 'attribute_id'], 'required'],
            [['entity_id', 'attribute_id', 'option_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Сущность',
            'attribute_id' => 'Аттрибут',
            'value' => 'Значение',
            'option_id' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::class, ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(EavAttributeOption::class, ['id' => 'option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Product::class, ['id' => 'entity_id']);
    }

    /**
     * @return string
     */
    public function getValue()
    {
      return 'XXX';
    }
}