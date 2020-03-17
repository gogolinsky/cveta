<?php

namespace app\modules\promo;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/promos' => '/promo/frontend/index',
                '/promos/<alias>' => '/promo/frontend/view',
            ],
        ]);
    }
}
