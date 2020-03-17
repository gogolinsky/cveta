<?php

namespace app\modules\slider\widgets;

use app\modules\slider\models\Slide;
use yii\base\Widget;

class SliderWidget extends Widget
{
    public function run()
    {
        $slides = Slide::find()->orderBy(['position' => SORT_ASC])->all();

        return $this->render('slider', compact('slides'));
    }
}