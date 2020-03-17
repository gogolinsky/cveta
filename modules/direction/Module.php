<?php

namespace app\modules\direction;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/directions' => '/direction/frontend/index',
                '/directions/<alias>' => '/direction/frontend/view',
            ],
        ]);
    }
}
