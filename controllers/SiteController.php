<?php

namespace app\controllers;

use app\modules\category\models\Category;
use app\modules\cert\models\Cert;
use app\modules\employee\models\Employee;
use app\modules\partner\models\Partner;
use app\modules\post\models\Post;
use app\modules\project\models\Project;
use yii\web\Controller;
use yii\web\ErrorAction;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
                'layout' => '/empty',
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'empty';
        $projects = Project::find()->orderBy(['position' => SORT_ASC])->limit(10)->all();
        $partners = Partner::find()->orderBy(['position' => SORT_ASC])->all();
        $posts = Post::find()->orderBy(['created_at' => SORT_DESC])->limit(10)->all();
        $categories = Category::find()->where(['depth' => 1])->orderBy(['lft' => SORT_ASC])->all();

        return $this->render('index', compact('projects', 'partners', 'posts', 'categories'));
    }

    public function actionAbout()
    {
        $this->layout = 'empty';
        $employees = Employee::find()->orderBy(['position' => SORT_ASC])->all();
        $partners = Partner::find()->orderBy(['position' => SORT_ASC])->all();
        $certs = Cert::find()->orderBy(['position' => SORT_ASC])->all();

        return $this->render('about', compact('employees', 'partners', 'certs'));
    }

    public function actionContact()
    {
        $this->layout = 'empty';

        return $this->render('contact');
    }
}
