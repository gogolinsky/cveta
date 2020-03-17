<?php

namespace app\modules\promo\controllers;

use app\modules\admin\components\BalletController;
use app\modules\promo\models\PromoSearch;
use app\modules\promo\models\Promo;
use Yii;
use yii\web\Response;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new PromoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $promo = new Promo();

        if ($promo->load(Yii::$app->request->post()) && $promo->save()) {
            return $this->redirect(['update', 'id' => $promo->id]);
        }

        return $this->render('create', compact('promo'));
    }

    public function actionUpdate($id)
    {
        $promo = Promo::getOrFail($id);

        if ($promo->load(Yii::$app->request->post()) && $promo->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('promo'));
    }

    public function actionSeo($id)
    {
        $promo = Promo::getOrFail($id);

        if ($promo->load(Yii::$app->request->post()) && $promo->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('promo'));
    }

    public function actionDelete($id)
    {
        Promo::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Promo::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Promo::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Promo::getOrFail($id)->moveNext();
    }
}
