<?php

namespace app\modules\post;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/blog' => '/post/frontend/index',
                '/blog/<alias>' => '/post/frontend/view',
            ],
        ]);
    }
}
