<?php

namespace app\modules\setting\types\map\widgets;

use app\modules\setting\types\map\MapSetting;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;

/**
 * @property ActiveForm $form
 * @property \app\modules\setting\types\map\MapSetting $mapSetting
 */
class MapSettingWidget extends Widget
{
    public $form;
    public $mapSetting;

    public function run()
    {
        return $this->render('map_setting', [
            'form' => $this->form,
            'mapSetting' => $this->mapSetting,
        ]);
    }

}