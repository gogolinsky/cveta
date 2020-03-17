<?php

namespace app\modules\slider\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\slider\models\SlideSearch;
use app\modules\slider\models\Slide;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new SlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $slider = new Slide();

        if ($slider->load(Yii::$app->request->post()) && $slider->save()) {
            return $this->redirect(['update', 'id' => $slider->id]);
        }

        return $this->render('create', compact('slider'));
    }

    public function actionUpdate($id)
    {
        $slider = Slide::getOrFail($id);

        if ($slider->load(Yii::$app->request->post()) && $slider->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('slider'));
    }

    public function actionDelete($id)
    {
        Slide::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Slide::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Slide::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Slide::getOrFail($id)->moveNext();
    }
}
