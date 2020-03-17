<?php

namespace app\modules\employee\controllers;

use app\modules\admin\components\BalletController;
use app\modules\employee\models\EmployeeSearch;
use app\modules\employee\models\Employee;
use Yii;
use yii\web\Response;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $employee = new Employee();

        if ($employee->load(Yii::$app->request->post()) && $employee->save()) {
            return $this->redirect(['update', 'id' => $employee->id]);
        }

        return $this->render('create', compact('employee'));
    }

    public function actionUpdate($id)
    {
        $employee = Employee::getOrFail($id);

        if ($employee->load(Yii::$app->request->post()) && $employee->save()) {
            return $this->refresh();
        }

        return $this->render('update', compact('employee'));
    }

    public function actionDelete($id)
    {
        Employee::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Employee::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }

    public function actionMoveUp($id)
    {
        return Employee::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        return Employee::getOrFail($id)->moveNext();
    }
}
