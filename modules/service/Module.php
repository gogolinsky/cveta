<?php

namespace app\modules\service;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/services' => '/service/frontend/index',
                '/services/<alias>' => '/service/frontend/view',
            ],
        ]);
    }
}
