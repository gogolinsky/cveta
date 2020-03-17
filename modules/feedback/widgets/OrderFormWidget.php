<?php

namespace app\modules\feedback\widgets;

use app\modules\feedback\forms\OrderForm;
use app\modules\feedback\models\Feedback;
use app\modules\product\models\Product;
use yii\base\Widget;

/**
 * @property Feedback $feedback
 * @property Product $product
 */
class OrderFormWidget extends Widget
{
    public $product;
    public $feedback;

    public function init()
    {
        if (empty($this->form)) {
            $this->feedback = new OrderForm();
        }
    }

    public function run()
    {
        return $this->render('order_form', [
            'feedback' => $this->feedback,
            'product' => $this->product,
        ]);
    }
}