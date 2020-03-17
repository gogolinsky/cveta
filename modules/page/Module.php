<?php

namespace app\modules\page;

use app\modules\page\components\Pages;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $rules = [];

        foreach (Pages::getPages() as $page) {
            if(!empty($page->route)) {
                $rules[$page->alias] = $page->route;
            } else {
                $rules["<alias:{$page->alias}>"] = '/page/frontend/view';
            }
        }

        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => $rules,
        ]);
    }
}
