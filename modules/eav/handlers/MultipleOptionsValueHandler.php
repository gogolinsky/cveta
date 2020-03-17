<?php

namespace app\modules\eav\handlers;

use yii\db\ActiveRecord;

/**
 * Class MultipleOptionsValueHandler
 * @package app\modules\eav\handlers
 */
class MultipleOptionsValueHandler extends ValueHandler
{
    /** @var AttributeHandler */
    public $attributeHandler;

    public function load()
    {
        $EavModel = $this->attributeHandler->owner;
        
        /** @var ActiveRecord $valueClass */
        $valueClass = $EavModel->valueClass;

        $models = $valueClass::findAll([
            'entity_id' => $EavModel->entityModel->getPrimaryKey(),
            'attribute_id' => $this->attributeHandler->attributeModel->getPrimaryKey(),
        ]);

        $values = [];
        foreach ($models as $model) {
            $values[] = $model->option_id;
        }

        return $values;
    }

    public function save()
    {
        $EavModel = $this->attributeHandler->owner;        
        $attribute = $this->attributeHandler->getAttributeName();    
        /** @var ActiveRecord $valueClass */
        $valueClass = $EavModel->valueClass;
        
        $baseQuery = $valueClass::find()->where([
            'entity_id' => $EavModel->entityModel->getPrimaryKey(),
            'attribute_id' => $this->attributeHandler->attributeModel->getPrimaryKey(),
        ]);

        $allOptions = [];
        foreach ($this->attributeHandler->attributeModel->eavOptions as $option){
            $allOptions[] = $option->getPrimaryKey();
        }

        $query = clone $baseQuery;
        $query->andWhere("option_id NOT IN (:options)");
        $valueClass::deleteAll($query->where, [
            'options' => implode(',', $allOptions),
        ]);        
        
        // then we delete unselected options
        $selectedOptions = $EavModel->attributes[$attribute];
        if (!is_array($selectedOptions)){
            $selectedOptions = [];
        }
        $deleteOptions = array_diff($allOptions, $selectedOptions);

        $query = clone $baseQuery;
        $query->andWhere("option_id IN (:options)");

        $valueClass::deleteAll($query->where, [
            'options' => implode(',', $deleteOptions),
        ]);

        // third we insert missing options
        foreach ($selectedOptions as $id) {
            $query = clone $baseQuery;
            $query->andWhere(['option_id' => $id]);

            $valueModel = $query->one();

            if (!$valueModel instanceof ActiveRecord) {
                /** @var ActiveRecord $valueModel */
                $valueModel = new $valueClass;
                $valueModel->entity_id = $EavModel->entityModel->getPrimaryKey();
                $valueModel->attribute_id = $this->attributeHandler->attributeModel->getPrimaryKey();
                $valueModel->option_id = $id;
                if (!$valueModel->save())
                    throw new \Exception("Can't save value model");
            }
        }
    }

    public function getTextValue()
    {
        $EavModel = $this->attributeHandler->owner;
        
        /** @var ActiveRecord $valueClass */
        $valueClass = $EavModel->valueClass;

        $models = $valueClass::findAll([
            'entity_id' => $EavModel->entityModel->getPrimaryKey(),
            'attribute_id' => $this->attributeHandler->attributeModel->getPrimaryKey(),
        ]);

        $values = [];
        foreach ($models as $model) {
            $values[] = $model->option->value;
        }

        return implode(', ', $values);
    }
}