<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\BalletController;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
