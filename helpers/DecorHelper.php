<?php

namespace app\helpers;

class DecorHelper
{
    public static function price($number)
    {
        return number_format($number, 0, '.', ' ') . ' руб.';
    }
}