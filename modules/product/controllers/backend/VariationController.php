<?php

namespace app\modules\product\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\product\models\Product;
use app\modules\product\models\Variation;
use app\modules\product\models\VariationSearch;
use Yii;
use yii\web\Response;

class VariationController extends BalletController
{
    public function actionIndex($id)
    {
        $product = Product::getOrFail($id);
        $searchModel = new VariationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->query->andWhere(['product_id' => $product->id]);

        return $this->render('index', compact('dataProvider', 'searchModel', 'product'));
    }

    public function actionCreate($id)
    {
        $product = Product::getOrFail($id);
        $variation = new Variation(['product_id' => $product->id]);

        if ($variation->load(Yii::$app->request->post()) && $variation->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['message' => 'success'];
        }

        return $this->renderAjax('create', compact('variation'));
    }

    public function actionUpdate($id)
    {
        $variation = Variation::getOrFail($id);

        if ($variation->load(Yii::$app->request->post()) && $variation->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['message' => 'success'];
        }

        return $this->renderAjax('update', compact('variation'));
    }

    public function actionDelete($id)
    {
        Variation::getOrFail($id)->delete();
    }

    public function actionMoveUp($id)
    {
        Variation::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Variation::getOrFail($id)->moveNext();
    }
}