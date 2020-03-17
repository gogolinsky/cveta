<?php

namespace app\modules\project\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\employee\models\Employee;
use app\modules\project\models\ProjectSearch;
use app\modules\project\models\Project;
use app\modules\product\models\Product;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $project = new Project();

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            return $this->redirect(['update', 'id' => $project->id]);
        }

        $products = Product::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();
        $employees = Employee::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();

        return $this->render('create', compact('project', 'products', 'employees'));
    }

    public function actionUpdate($id)
    {
        $project = Project::getOrFail($id);

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            return $this->refresh();
        }

        $products = Product::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();
        $employees = Employee::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();

        return $this->render('update', compact('project', 'products', 'employees'));
    }

    public function actionReview($id)
    {
        $project = Project::getOrFail($id);

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            return $this->refresh();
        }

        return $this->render('review', compact('project'));
    }

    public function actionDelete($id)
    {
        Project::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Project::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionDeleteImageReview($id)
    {
        Project::getOrFail($id)->deleteImageReview();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionSeo($id)
    {
        $project = Project::getOrFail($id);

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('project'));
    }
}
