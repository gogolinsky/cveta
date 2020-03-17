<?php

namespace app\modules\setting\helpers;

use app\modules\setting\SettingFactory;

class SettingHelper
{
    public static function getTypesDropDown() {
        return array_map(function($class) {
            return $class::NAME;
        }, SettingFactory::types());
    }
}