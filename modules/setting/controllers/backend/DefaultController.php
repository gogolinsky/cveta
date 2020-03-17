<?php

namespace app\modules\setting\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\setting\SettingFactory;
use app\modules\setting\models\Setting;
use app\modules\setting\models\SettingSearch;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }
    
    public function actionCreate()
    {
        $setting = SettingFactory::create('string');

        if ($setting->load(Yii::$app->request->post()) && $setting->save()) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['message' => 'success'];
            } else {
                return $this->redirect(['update', 'id' => $setting->id]);
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', compact('setting'));
        } else {
            return $this->render('create', compact('setting'));
        }
    }

    public function actionUpdate($id)
    {
        $setting = Setting::getOrFail($id);

        if ($setting->load(Yii::$app->request->post()) && $setting->save()) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['message' => 'success'];
            }

            return $this->refresh();
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', compact('setting'));
        }

        return $this->render('update', compact('setting'));
    }

    public function actionDelete($id)
    {
        Setting::getOrFail($id)->delete();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionMoveUp($id)
    {
        Setting::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Setting::getOrFail($id)->moveNext();
    }
}