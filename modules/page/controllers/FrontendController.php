<?php

namespace app\modules\page\controllers;

use app\modules\page\components\Pages;
use app\modules\page\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FrontendController extends Controller
{
    public function actionView($alias)
    {
        $page = Page::findOne(['alias' => $alias]);

        if (empty($page)) {
            throw new NotFoundHttpException();
        }

        Pages::setCurrentPage($page);

        return $this->render('view');
    }
}