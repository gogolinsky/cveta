<?php

namespace app\modules\eav\handlers;

/**
 * Class RawValueHandler
 * @package app\modules\eav\handlers
 */
class RawValueHandler extends ValueHandler
{
    /**
     * @inheritdoc
     */
    public function load()
    {
        $valueModel = $this->getValueModel();
        return $valueModel->value;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $EavModel = $this->attributeHandler->owner;
        $valueModel = $this->getValueModel();
        $attribute = $this->attributeHandler->getAttributeName();
        
        if(isset($EavModel->attributes[$attribute])){
          
          $valueModel->value = $EavModel->attributes[$attribute];
              
          if (!$valueModel->save())
              throw new \Exception("Can't save value model");
            
        }
    }

    public function getTextValue()
    {
        return $this->getValueModel()->value;
    }
}