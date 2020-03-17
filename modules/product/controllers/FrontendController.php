<?php

namespace app\modules\product\controllers;

use app\modules\product\models\Product;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionView($id)
    {
        $this->layout = '/empty';
        $product = Product::getOrFail($id);
        $variations = $product->variations;
        $category = $product->category;
        $vendor = $product->vendor;
        $parents = $category->parents()->andWhere(['>', 'depth', 0])->all();
        $options = $product->getEavAttributes()->orderBy(['position' => SORT_ASC])->all();
        $images = $product->images;
        $view = $this->getViewForProduct($product);

        return $this->render($view, compact('product', 'category', 'vendor', 'parents', 'options', 'variations', 'images'));
    }

    private function getViewForProduct(Product $product)
    {
        switch ($product->view) {
            case Product::VIEW_CALCULATOR:
                return 'view_calculator';
            case Product::VIEW_COLOR:
                return 'view_color';
        }

        return 'view';
    }
}
