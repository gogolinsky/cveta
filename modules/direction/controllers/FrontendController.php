<?php

namespace app\modules\direction\controllers;

use app\modules\filter\forms\FilterForm;
use app\modules\direction\models\Direction;
use app\modules\product\widgets\ListWidget;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $this->layout = '/thin';
        $directions = Direction::find()->orderBy(['position' => SORT_ASC])->all();

        return $this->render('index', compact('directions'));
    }

    public function actionView($alias)
    {
        $this->layout = '/empty';
        $direction = Direction::getOrFail(compact('alias'));
        $filterForm = new FilterForm(compact('direction'));
        $filterForm->load(Yii::$app->request->get());
        $dataProvider = $filterForm->filter();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['html' => ListWidget::widget(compact('dataProvider'))];
        }

        return $this->render('view', compact('direction', 'filterForm', 'dataProvider'));
    }
}


