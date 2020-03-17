<?php

namespace app\widgets;

use yii\base\Widget;

class PleasureWidget extends Widget
{
    public function run()
    {
        return $this->render('pleasure');
    }
}