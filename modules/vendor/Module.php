<?php

namespace app\modules\vendor;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/vendors' => '/vendor/frontend/index',
                '/vendors/<alias>' => '/vendor/frontend/view',
            ]
        ]);
    }
}
