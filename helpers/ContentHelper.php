<?php

namespace app\helpers;

class ContentHelper
{
    public static function addLabel($num, $titles = ['товар', 'товара', 'товаров'])
    {
        $cases = [2, 0, 1, 1, 1, 2];

        return $num . ' ' . $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
    }

    public static function splitText($text, $delimiter = PHP_EOL, $limit = PHP_INT_MAX) : array
    {
        return array_filter(explode($delimiter, $text, $limit));
    }
}