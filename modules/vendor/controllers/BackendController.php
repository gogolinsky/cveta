<?php

namespace app\modules\vendor\controllers;

use app\modules\admin\components\BalletController;
use app\modules\vendor\models\Vendor;
use app\modules\vendor\models\VendorSearch;
use Yii;
use yii\web\Response;
use yiidreamteam\upload\ImageUploadBehavior;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $vendor = new Vendor();

        if ($vendor->load(Yii::$app->request->post()) && $vendor->save()) {
            return $this->redirect(['update', 'id' => $vendor->id]);
        }

        return $this->render('create', compact('vendor'));
    }

    public function actionUpdate($id)
    {
        $vendor = Vendor::getOrFail($id);

        if ($vendor->load(Yii::$app->request->post()) && $vendor->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('vendor'));
    }

    public function actionMoveUp($id)
    {
        Vendor::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Vendor::getOrFail($id)->moveNext();
    }

    public function actionDelete($id)
    {
        Vendor::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        $vendor = Vendor::getOrFail($id);
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $vendor->getBehavior('image');
        $imageBehavior->cleanFiles();
        $vendor->updateAttributes(['image' => null]);

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }

    public function actionDeleteBackground($id)
    {
        $vendor = Vendor::getOrFail($id);
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $vendor->getBehavior('background');
        $imageBehavior->cleanFiles();
        $vendor->updateAttributes(['background' => null]);

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }
}