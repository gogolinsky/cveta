<?php

namespace app\modules\setting;

use app\modules\setting\types\FileSetting;
use app\modules\setting\types\HtmlSetting;
use app\modules\setting\types\map\MapSetting;
use app\modules\setting\types\StringSetting;
use app\modules\setting\types\TextSetting;

class SettingFactory
{
    private static $types = [
        StringSetting::TYPE => StringSetting::class,
        TextSetting::TYPE => TextSetting::class,
        FileSetting::TYPE => FileSetting::class,
        HtmlSetting::TYPE => HtmlSetting::class,
        MapSetting::TYPE => MapSetting::class,
    ];

    public static function types() {

        return self::$types;
    }

    public static function create($type, $params = [])
    {
        $class = self::getClass($type);
        return new $class($params);
    }

    public static function getClass($type)
    {
        $types = self::types();
        return $types[$type];
    }
}