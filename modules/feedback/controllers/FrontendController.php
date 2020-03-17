<?php

namespace app\modules\feedback\controllers;

use app\modules\feedback\factories\FormFactory;
use Exception;
use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionSend()
    {
        try {
            $form = FormFactory::create(Yii::$app->request->post('type'));
        } catch (Exception $e) {
            return $this->goHome();
        }

        $form->ref = Yii::$app->request->referrer;

        if ($form->load(Yii::$app->request->post()) && $form->insert()) {
            Yii::$app->session->setFlash('success');
            return $this->redirect(['success']);
        }

        Yii::$app->session->setFlash('error');

        return $this->redirect(['error']);
    }

    public function actionSuccess()
    {
        $this->layout = '/empty';

        if (Yii::$app->session->getFlash('success')) {
            return $this->render('success');
        }

        return $this->goHome();
    }

    public function actionError()
    {
        $this->layout = '/empty';

        if (Yii::$app->session->getFlash('error')) {
            return $this->render('error');
        }

        return $this->goHome();
    }
}