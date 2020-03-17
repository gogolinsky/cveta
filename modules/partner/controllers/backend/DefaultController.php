<?php

namespace app\modules\partner\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\partner\models\PartnerSearch;
use app\modules\partner\models\Partner;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $partner = new Partner();

        if ($partner->load(Yii::$app->request->post()) && $partner->save()) {
            return $this->redirect(['update', 'id' => $partner->id]);
        }

        return $this->render('create', compact('partner'));
    }

    public function actionUpdate($id)
    {
        $partner = Partner::getOrFail($id);

        if ($partner->load(Yii::$app->request->post()) && $partner->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('partner'));
    }

    public function actionDelete($id)
    {
        Partner::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Partner::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Partner::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Partner::getOrFail($id)->moveNext();
    }
}
