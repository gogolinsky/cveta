<?php

namespace app\modules\eav\controllers;

use app\modules\admin\components\BalletController;
use app\modules\eav\models\EavAttributeOption;
use Exception;
use Yii;
use app\modules\eav\models\EavAttribute;
use app\modules\eav\models\EavAttributeSearch;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new EavAttributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $model = new EavAttribute();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = EavAttribute::getOrFail($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('_main', compact('model'));
    }

    public function actionOptions($id)
    {
        $model = EavAttribute::getOrFail($id);

        if (!in_array($model->type_id, [2, 3, 5])) {
            throw new Exception('Attribute can not have options');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('_options', compact('model'));
    }

    public function actionOptionCreate($id)
    {
        $attribute = EavAttribute::getOrFail($id);
        /** @var EavAttributeOption $model */
        $model = new EavAttributeOption();
        $model->attribute_id = $id;

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                return ['message' => 'success'];
            }

            return ['message' => 'fail'];
        }

        return $this->renderAjax('_option_create', compact('model', 'attribute'));
    }

    public function actionOptionUpdate($id)
    {
        /** @var EavAttributeOption $model */
        $model = EavAttributeOption::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                return ['message' => 'success'];
            }

            return ['message' => 'fail'];
        }

        return $this->renderAjax('_option', compact('model'));
    }

    public function actionOptionDelete($id)
    {
        $model = EavAttributeOption::findOne($id);

        if (null === $model) {
            throw new NotFoundHttpException('Option not found');
        }

        $model->delete();
    }

    public function actionDelete($id)
    {
        EavAttribute::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMoveUp($id)
    {
        $eavAttribute = EavAttribute::getOrFail($id);
        return $eavAttribute->movePrev();
    }

    public function actionMoveDown($id)
    {
        $eavAttribute = EavAttribute::getOrFail($id);
        return $eavAttribute->moveNext();
    }

    public function actionDeleteIcon($id)
    {
        EavAttribute::getOrFail($id)->deleteIcon();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }
}
