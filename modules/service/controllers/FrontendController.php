<?php

namespace app\modules\service\controllers;

use app\modules\service\models\Service;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $this->layout = '/thin';
        $services = Service::find()->orderBy(['position' => SORT_ASC])->all();

        return $this->render('index', compact('services'));
    }

    public function actionView($alias)
    {
        $this->layout = '/empty';
        $service = Service::getOrFail(compact('alias'));

        return $this->render('view', compact('service'));
    }
}


