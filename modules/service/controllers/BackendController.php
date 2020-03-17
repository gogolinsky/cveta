<?php

namespace app\modules\service\controllers;

use app\modules\admin\components\BalletController;
use app\modules\service\models\ServiceSearch;
use app\modules\service\models\Service;
use Yii;
use yii\web\Response;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $service = new Service();

        if ($service->load(Yii::$app->request->post()) && $service->save()) {
            return $this->redirect(['update', 'id' => $service->id]);
        }

        return $this->render('create', compact('service'));
    }

    public function actionUpdate($id)
    {
        $service = Service::getOrFail($id);

        if ($service->load(Yii::$app->request->post()) && $service->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('service'));
    }

    public function actionSeo($id)
    {
        $service = Service::getOrFail($id);

        if ($service->load(Yii::$app->request->post()) && $service->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('service'));
    }

    public function actionDelete($id)
    {
        Service::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Service::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Service::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Service::getOrFail($id)->moveNext();
    }
}
