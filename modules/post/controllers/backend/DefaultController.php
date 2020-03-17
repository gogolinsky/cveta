<?php

namespace app\modules\post\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\post\models\PostSearch;
use app\modules\post\models\Post;
use app\modules\product\models\Product;
use Yii;
use yii\web\Response;

class DefaultController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $post = new Post();

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            return $this->redirect(['update', 'id' => $post->id]);
        }

        $products = Product::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();

        return $this->render('create', compact('post', 'products'));
    }

    public function actionUpdate($id)
    {
        $post = Post::getOrFail($id);

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            return $this->refresh();
        }

        $products = Product::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();

        return $this->render('update', compact('post', 'products'));
    }

    public function actionDelete($id)
    {
        Post::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        Post::getOrFail($id)->deleteImage();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionSeo($id)
    {
        $post = Post::getOrFail($id);

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('post'));
    }
}
