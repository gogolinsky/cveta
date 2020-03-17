<?php

namespace app\modules\eav\handlers;

/**
 * Class OptionValueHandler
 * @package app\modules\eav\handlers
 */
class OptionValueHandler extends ValueHandler
{
    /**
     * @inheritdoc
     */
    public function load()
    {
        $valueModel = $this->getValueModel();
        return $valueModel->option_id;
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
          
          $valueModel->option_id = $EavModel->attributes[$attribute];
              
          if (!$valueModel->save())
              throw new \Exception("Can't save value model");
            
        }        
        
    }

    public function getTextValue()
    {
        return $this->getValueModel()->option->value;
    }
}