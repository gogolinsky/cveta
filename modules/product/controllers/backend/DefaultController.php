<?php

namespace app\modules\product\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\direction\models\Direction;
use app\modules\eav\traits\EavControllerTrait;
use app\modules\product\models\Product;
use app\modules\product\models\ProductSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Response;
use yiidreamteam\upload\ImageUploadBehavior;

class DefaultController extends BalletController
{
    use EavControllerTrait;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['POST'],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $product = new Product();

        if ($product->load(Yii::$app->request->post()) && $product->save()) {
            Yii::$app->session->setFlash('success', 'Выполнено');
            return $this->redirect(Url::to(['update', 'id' => $product->id]));
        }

        $directions = Direction::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();

        return $this->render('create', compact('product', 'directions'));
    }

    public function actionUpdate($id)
    {
        $product = Product::getOrFail($id);

        if ($product->load(Yii::$app->request->post()) && $product->save()) {
            return $this->refresh();
        }

        $directions = Direction::find()->orderBy(['title' => SORT_ASC])->select(['title'])->indexBy('id')->column();

        return $this->render('update', compact('product', 'directions'));
    }

    public function actionSeo($id)
    {
        $product = Product::getOrFail($id);

        if ($product->load(Yii::$app->getRequest()->post()) && $product->save()) {
            return $this->refresh();
        }

        return $this->render('seo', compact('product'));
    }

    public function actionDelete($id)
    {
        Product::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id)
    {
        $product = Product::getOrFail($id);
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $product->getBehavior('image');
        $imageBehavior->cleanFiles();
        $product->updateAttributes(['image' => null]);

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }
}
