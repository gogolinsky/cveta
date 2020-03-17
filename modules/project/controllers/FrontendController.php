<?php

namespace app\modules\project\controllers;

use app\modules\project\models\Project;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $this->layout = '/thin';
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find(),
            'pagination' => ['defaultPageSize' => 20, 'forcePageParam' => false],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionView($alias)
    {
        $this->layout = '/empty';
        $project = Project::getOrFail(compact('alias'));
        $products = $project->products;
        $employees = $project->employees;
        $images = $project->images;
        $nextProject = Project::find()->orderBy(['id' => SORT_ASC])->where(['>', 'id', $project->id])->exists()
            ? Project::find()->orderBy(['id' => SORT_ASC])->where(['>', 'id', $project->id])->limit(1)->one()
            : Project::find()->orderBy(['id' => SORT_ASC])->limit(1)->one();

        return $this->render('view', compact('project', 'products', 'employees', 'images', 'nextProject'));
    }
}


