<?php

namespace app\helpers;

use yii\helpers\Html;

class FormatHelper
{
    public static function fileSize($file, $decimals = 2)
    {
        if (!is_file($file)) {
            return '';
        }
        $bytes = filesize($file);
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    public static function number($number)
    {
        return number_format($number, 0, ',', ' ');
    }

    public static function nText($text)
    {
        return nl2br(Html::encode($text));
    }
}