<?php

namespace app\modules\eav\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%eav_attribute_type}}".
 *
 * @property int $id
 * @property string $name
 * @property string $handler_class
 * @property int $store_type
 *
 * @property EavAttribute[] $eavAttributes
 */
class EavAttributeType extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%eav_attribute_type}}';
    }

    public static function getList()
    {
        return [
            1 => 'Текстовое поле',
            2 => 'Выпадающий список',
            3 => 'Множественный выбор',
        ];
    }

    public function rules()
    {
        return [
            [['store_type'], 'integer'],
            [['name', 'handler_class'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'handler_class' => 'Класс',
            'store_type' => 'Способ хранения',
        ];
    }

    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::class, ['type_id' => 'id']);
    }
}