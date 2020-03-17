<?php

namespace app\modules\direction\controllers;

use app\modules\admin\components\BalletController;
use app\modules\direction\models\Direction;
use app\modules\direction\models\DirectionSearch;
use Yii;
use yii\web\Response;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new DirectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $direction = new Direction();

        if ($direction->load(Yii::$app->request->post()) && $direction->save()) {
            return $this->redirect(['update', 'id' => $direction->id]);
        }

        return $this->render('create', compact('direction'));
    }

    public function actionUpdate($id)
    {
        $direction = Direction::getOrFail($id);

        if ($direction->load(Yii::$app->request->post()) && $direction->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('direction'));
    }

    public function actionSeo($id)
    {
        $direction = Direction::getOrFail($id);

        if ($direction->load(Yii::$app->request->post()) && $direction->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('direction'));
    }

    public function actionDelete($id)
    {
        Direction::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Direction::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Direction::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Direction::getOrFail($id)->moveNext();
    }
}
