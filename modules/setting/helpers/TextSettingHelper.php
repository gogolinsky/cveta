<?php

namespace app\modules\setting\helpers;

class TextSettingHelper
{
    public static function toArray(string $text, $delimiter = PHP_EOL) : array
    {
        return array_filter(explode($delimiter, $text));
    }
}