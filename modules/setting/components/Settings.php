<?php

namespace app\modules\setting\components;

use app\modules\setting\models\Setting;

class Settings
{
    /**
     * @var Setting[] $settings
     */
    private static $settings = [];

    public static function getRealValue($id)
    {
        $setting = self::getSetting($id);
        return !empty($setting) ? $setting->value : '';
    }

    public static function getSetting($id)
    {
        if (empty(self::$settings[$id])) {
            self::$settings[$id] = Setting::findOne($id);
        }

        return self::$settings[$id];
    }

    public static function getArray($id)
    {
        $setting = self::getSetting($id);

        return !empty($setting) ? $setting->getArray() : [];
    }
}