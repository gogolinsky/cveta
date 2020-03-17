<?php

namespace app\modules\admin\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class OptionsBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
        ];
    }

    public function onBeforeSave()
    {
        $i = 0;
        $this->owner->options_mask = 0;

        foreach ($this->owner->options as $option) {
            $this->owner->options_mask += ((int)$option << $i++);
        }
    }

    public function onAfterFind()
    {
        $i = 0;
        foreach ($this->owner->options as &$option) {
            $option = (bool)($this->owner->options_mask & (1 << $i++));
        }
    }
}