<?php

namespace app\modules\eav\helpers;

use app\modules\eav\models\EavAttribute;

class Html extends \yii\helpers\Html
{
    public static function activeEavInput($model, $attribute, $options = [])
    {
//        $handlerClass = EavAttribute::find()
//            ->select(['{{%eav_attribute_type}}.handler_class'])
//            ->innerJoin('{{%eav_attribute_type}}', '{{%eav_attribute_type}}.id = {{%eav_attribute}}.type_id')
//            ->where([
//                '{{%eav_attribute}}.name' => $attribute
//            ])
//            ->scalar();
//
//        $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
        $eavModel = static::getAttributeValue($model, $attribute);
        $handler = $eavModel->handlers[$attribute];

        $handler->owner->activeForm = $options['form'];

        return $handler->run();
    }

}