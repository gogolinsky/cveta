<?php

namespace app\modules\admin\components;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class BalletController extends Controller
{
    public $layout = '@app/modules/admin/views/layouts/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->homeUrl = ['/admin/default/index'];
        return parent::beforeAction($action);
    }
}