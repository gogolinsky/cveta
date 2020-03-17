<?php

namespace app\modules\product\widgets;

use app\modules\product\models\Product;
use yii\base\Widget;

class ProductsBoxWidget extends Widget
{
    public function run()
    {
        $products = Product::find()->joinWith('category')->orderBy(['updated_at' => SORT_DESC])->limit(4)->all();

        return $this->render('products_box', compact('products'));
    }
}