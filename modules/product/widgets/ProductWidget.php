<?php

namespace app\modules\product\widgets;

use app\modules\product\models\Product;
use yii\base\Widget;

/**
 * @property Product $product
 */
class ProductWidget extends Widget
{
    public $product;

    public function run()
    {
        $product = $this->product;
        $image = !empty($product->images) ? $product->images[0]->getThumbFileUrl('image', 'thumb') : '';

        return $this->render('product', compact('product', 'image'));
    }
}
