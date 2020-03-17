<?php

namespace app\modules\post\controllers;

use app\modules\post\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
            'pagination' => ['defaultPageSize' => 20, 'forcePageParam' => false],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionView($alias)
    {
        $this->layout = '/empty';
        $post = Post::getOrFail(compact('alias'));
        $products = $post->products;
        $images = $post->images;

        return $this->render('view', compact('post', 'products', 'images'));
    }
}


