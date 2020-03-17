<?php

namespace app\modules\cert\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\cert\models\CertSearch;
use app\modules\cert\models\Cert;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new CertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $cert = new Cert();

        if ($cert->load(Yii::$app->request->post()) && $cert->save()) {
            return $this->redirect(['update', 'id' => $cert->id]);
        }

        return $this->render('create', compact('cert'));
    }

    public function actionUpdate($id)
    {
        $cert = Cert::getOrFail($id);

        if ($cert->load(Yii::$app->request->post()) && $cert->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('cert'));
    }

    public function actionDelete($id)
    {
        Cert::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Cert::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Cert::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Cert::getOrFail($id)->moveNext();
    }
}
