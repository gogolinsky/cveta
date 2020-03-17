<?php

namespace app\widgets;

use yii\base\Widget;

class SelectionWidget extends Widget
{
    public function run()
    {
        return $this->render('selection');
    }
}