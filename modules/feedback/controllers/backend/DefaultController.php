<?php

namespace app\modules\feedback\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\feedback\factories\FormFactory;
use app\modules\feedback\models\Feedback;
use app\modules\feedback\models\FeedbackSearch;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex($type)
    {
        $instanceForm = FormFactory::create($type);
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->query->andWhere(['type' => $instanceForm::TYPE]);

        return $this->render('index', compact('searchModel', 'dataProvider', 'instanceForm'));
    }

    public function actionView($id)
    {
        $feedback = Feedback::getOrFail($id);

        if ($feedback->load(Yii::$app->request->post()) && $feedback->save(true, ['status'])) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['message' => 'success'];
        }

        return $this->renderAjax('view', compact('feedback'));
    }
}