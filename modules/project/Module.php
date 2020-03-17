<?php

namespace app\modules\project;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/portfolio' => '/project/frontend/index',
                '/portfolio/<alias>' => '/project/frontend/view',
            ],
        ]);
    }
}
