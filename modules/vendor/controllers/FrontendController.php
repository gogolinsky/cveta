<?php

namespace app\modules\vendor\controllers;

use app\modules\vendor\models\Vendor;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class FrontendController extends  Controller
{
    public function actionIndex()
    {
        $vendors = Vendor::find()->orderBy('position')->all();

        return $this->render('index', compact('vendors'));
    }

    public function actionView($alias)
    {
        $this->layout = '/empty';
        $vendor = Vendor::getOrFail(compact('alias'));
        $dataProvider = new ActiveDataProvider([
            'query' => $vendor->getProducts(),
            'pagination' => ['defaultPageSize' => 50, 'forcePageParam' => false],
            'sort' => ['defaultOrder' => ['title' => SORT_ASC]]
        ]);

        return $this->render('view', compact('vendor', 'dataProvider'));
    }
}