<?php

namespace app\widgets;

use yii\base\Widget;

class GuaranteesWidget extends Widget
{
    public function run()
    {
        return $this->render('guarantees');
    }
}