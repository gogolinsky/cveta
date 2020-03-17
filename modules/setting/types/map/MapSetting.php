<?php

namespace app\modules\setting\types\map;

use app\modules\setting\models\Setting;
use app\modules\setting\types\map\widgets\MapSettingWidget;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;

/**
 * Class MapSetting
 * @package app\modules\setting\types
 */
class MapSetting extends Setting
{
    const TYPE = 'map';
    const NAME = 'Карта';

    public function formField(ActiveForm $form)
    {
        return MapSettingWidget::widget([
            'form' => $form,
            'mapSetting' => $this,
        ]);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getArray()
    {
        return Json::decode($this->value);
    }
}