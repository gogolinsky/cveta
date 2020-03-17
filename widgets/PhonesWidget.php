<?php

namespace app\widgets;

use app\modules\setting\components\Settings;
use yii\base\Widget;

class PhonesWidget extends Widget
{
    public function run()
    {
    	$phones = Settings::getArray('phones');

        return $this->render('phones', compact('phones'));
    }
}