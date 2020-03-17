<?php

namespace app\modules\eav;

use app\modules\eav\handlers\AttributeHandler;
use app\modules\eav\handlers\ValueHandler;
use app\modules\eav\models\EavAttribute;
use Yii;
use yii\base\DynamicModel as BaseEavModel;
use yii\db\ActiveRecord;
use yii\bootstrap\ActiveForm;

/**
 * Class EavModel
 * @package app\modules\eav
 */
class EavModel extends BaseEavModel
{
    /** @var string Class to use for storing data */
    public $valueClass;
    /** @var ActiveRecord */
    public $entityModel;
    /** @var AttributeHandler[] */
    public $handlers;
    /** @var string */
    public $attribute = '';    
    /** @var ActiveForm */
    public $activeForm;
    /** @var string[] */
    private $attributeLabels = [];

    /**
     * Constructor for creating form model from entity object
     *
     * @param array $params
     * @return static
     */
    public static function create($params)
    {
        $params['class'] = static::className();
        /** @var \yii\base\DynamicModel $model */
        $model = Yii::createObject($params);
        $params = [];
        
        if (!empty($params['attribute'])) {
          $params = ['name' => $params['attribute']];
        }
        
        $attributes = $model
          ->entityModel
          ->getRelation('eavAttributes')
          ->where($params)
          ->all();                             
          
        foreach ($attributes as $attribute) {          
        
            $handler = AttributeHandler::load($model, $attribute);
            $key = $handler->getAttributeName();
            $value = $handler->valueHandler->load();
            $model->setLabel($key, $handler->getAttributeLabel());
            
            /** Add rules */
            if ($attribute->required) {
                $model->addRule($key, 'required');
            } else {
                $model->addRule($key, 'safe');
            }

            if ($attribute->eavType->store_type == ValueHandler::STORE_TYPE_RAW) {
                $model->addRule($key, 'default', ['value' => $attribute->default_value]);
            }

            if ($attribute->eavType->store_type == ValueHandler::STORE_TYPE_OPTION){
                $model->addRule($key, 'default', ['value' => $attribute->default_option_id]);
            }
            
            if ($attribute->eavType->store_type == ValueHandler::STORE_TYPE_ARRAY) {
                $model->addRule($key, 'string');
            }

            /** Add define attribute */
            $model->defineAttribute($key, $value);

            /** Add handler */
            $model->handlers[$key] = $handler;
        
        }
        
        if (Yii::$app->request->getIsConsoleRequest() == false && Yii::$app->request->isPost) {
          $modelName = substr(strrchr(self::className(), "\\"), 1);
          $model->load(Yii::$app->request->post(), $modelName);         
        }                

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function getAttributeLabels()
    {
        return $this->attributeLabels;
    }

    /**
     * @param $name
     * @param $label
     */
    public function setLabel($name, $label)
    {
        $this->attributeLabels[$name] = $label;
    }

    /**
     * @param bool $runValidation
     * @param null $attributes
     * @return bool
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    public function save($runValidation = true, $attributes = null)
    {
        if (!$this->handlers) {
          Yii::info('Dynamic model data were no attributes.', __METHOD__);
          return false;
        }
        
        if ($runValidation && !$this->validate($attributes)) {
            Yii::info('Dynamic model data were not save due to validation error.', __METHOD__);
            return false;
        }

        $db = $this->entityModel->getDb();
        $transaction = $db->beginTransaction();

        try {
            foreach ($this->handlers as $handler) {
                $handler->valueHandler->save();
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
      $this->defineAttribute($name, $value);      
    }

    /**
     * @return string
     */
    public function getValue()
    {
        if (isset($this->attributes[ $this->attribute ])) {
            return $this->attributes[ $this->attribute ];
        }

        return '';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (isset($this->attributes[$this->attribute])) {
            if (is_string($this->attributes[$this->attribute])) {
                return (string) $this->attributes[$this->attribute];
            }

            return (string) json_encode($this->attributes[ $this->attribute ]);
        }

        return '';
    }

    /**
     * Return value, if attribute is string etc.,
     * and string value if attribute is dropDown
     * @return string
     */
    public function getRealValue()
    {
        /** @var EavAttribute $eavAttribute */
        $eavAttribute = EavAttribute::findOne(['name' => $this->attribute]);
        /** @var ActiveRecord $valueClass */
        $valueClass = $this->valueClass;
        $valueModels = $valueClass::findAll([
            'entity_id' => $this->entityModel->getPrimaryKey(),
            'attribute_id' => $eavAttribute->id,
        ]);

        if (sizeof($valueModels) == 1) { // Одно значение
            $valueModel = $valueModels[0];

            if (in_array($eavAttribute->type_id, [2, 5])) {
                if (null === $valueModel->option) {
                    return null;
                }

                return $valueModel->option->value;
            }

            return $valueModel->value;

        } elseif (sizeof($valueModels) > 1) {
            if (in_array($eavAttribute->type_id, [3])) { // Множественное значение
                return implode(', ', array_filter(array_map(function ($valueModel) {
                    return $valueModel->option_id ? $valueModel->option->value : null;
                }, $valueModels)));
            }
        }

        return null;
    }
}