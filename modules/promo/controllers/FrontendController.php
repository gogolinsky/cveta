<?php

namespace app\modules\promo\controllers;

use app\modules\promo\models\Promo;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $this->layout = '/thin';
        $promos = Promo::find()->orderBy(['position' => SORT_ASC])->all();

        return $this->render('index', compact('promos'));
    }

    public function actionView($alias)
    {
        $this->layout = '/empty';
        $promo = Promo::getOrFail(compact('alias'));

        return $this->render('view', compact('promo'));
    }
}


