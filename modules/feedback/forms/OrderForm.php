<?php

namespace app\modules\feedback\forms;

use app\modules\feedback\models\Feedback;

class OrderForm extends Feedback
{
    const TYPE = 'order';
    const TITLE = 'Заказ товара';
    const ICON = 'shopping-cart';

    public function gridAttrs()
    {
        return ['created_at', 'status',  'phone', 'name'];
    }
}