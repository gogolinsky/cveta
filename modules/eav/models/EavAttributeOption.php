<?php

namespace app\modules\eav\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%eav_attribute_option}}".
 *
 * @property integer $id
 * @property integer $attribute_id
 * @property string $value
 * @property string $default_option_id
 *
 * @property EavAttribute[] $eavAttributes
 * @property EavAttribute $eavAttribute
 * @property EavAttributeValue[] $eavAttributeValues
 */
class EavAttributeOption extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%eav_attribute_option}}';
    }

    public function rules()
    {
        return [
            [['attribute_id'], 'integer'],
            [['default_option_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_id' => 'Аттрибут',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::class, ['default_option_id' => 'id']);
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
    public function getValues()
    {
        return $this->hasMany(EavAttributeValue::class, ['option_id' => 'id']);
    }
}