<?php

namespace app\modules\user\traits;

use app\modules\user\Module;
use Yii;

trait ModuleTrait
{
    public function getModule(): Module
    {
        return Yii::$app->getModule('user');
    }
}
