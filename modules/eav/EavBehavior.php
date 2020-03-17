<?php

namespace app\modules\eav;

use app\modules\eav\models\EavAttribute;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class EavBehavior
 * @package app\modules\eav
 *
 * @mixin ActiveRecord
 * @property EavModel $eav;
 * @property ActiveRecord $owner
 */
class EavBehavior extends Behavior
{
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }
    
    /** @var array */
    public $valueClass;

    protected $EavModel;

    public function init()
    {
        assert(isset($this->valueClass));
    }

    /**
     * @param string $name
     * @return EavModel
     */
    public function __get($name = '')
    {
        $this->EavModel = EavModel::create([
            'entityModel' => $this->owner,
            'valueClass' => $this->valueClass,
            'attribute' => $name,
        ]);

        return $this->EavModel;
    }

    /**
     * @param string $name
     * @param bool $checkVars
     * @return bool
     */
    public function canGetProperty($name, $checkVars = true)
    {
        return EavAttribute::find()->where(['name' => $name])->exists();
    }

    /**
     * @return bool
     */
    public function beforeValidate() 
    {
        static $running;
        
        if (empty($running)) {
          $running = true;

          return $this->owner->validate();
        }
        
        $running = false;
    }

    /**
     * @param $attribute
     * @return false|null|string
     */
    public function getLabel($attribute)
    {
      return EavAttribute::find()->select(['label'])->where(['name' => $attribute])->scalar();
    }

    public function afterSave() 
    {
        $this->eav->save(false);
    }
    
}