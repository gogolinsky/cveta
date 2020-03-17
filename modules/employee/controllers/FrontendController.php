<?php

namespace app\modules\employee\controllers;

use app\modules\employee\models\Employee;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionView($id)
    {
        $employee = Employee::getOrFail(compact('id'));

        return $this->renderAjax('view', compact('employee'));
    }
}


