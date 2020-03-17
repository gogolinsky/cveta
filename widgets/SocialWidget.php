<?php

namespace app\widgets;

use app\modules\setting\components\Settings;
use yii\base\Widget;

class SocialWidget extends Widget
{
    public $htmlClass = '';

    public function run()
    {
        $instagram =  Settings::getRealValue('instagram');
        $facebook =  Settings::getRealValue('facebook');
        $vk =  Settings::getRealValue('vk');
        $htmlClass = $this->htmlClass;

        return $this->render('social', compact('instagram', 'facebook', 'vk', 'htmlClass'));
    }
}