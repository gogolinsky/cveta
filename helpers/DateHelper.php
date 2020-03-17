<?php

namespace app\helpers;

class DateHelper
{
    public static function forHuman($timestamp, $format = 'd n Y')
    {
        $format = str_replace('n' , self::getMonthName(date('n', $timestamp)), $format);
        return date($format, $timestamp);
    }

    public static function forHumanShortMonth($timestamp)
    {
        return date('d', $timestamp) . ' ' . self::getShortMonthName(date('n', $timestamp)) . ' ' . date('Y', $timestamp);
    }

    public static function forRobot($timestamp)
    {
        return date('Y-m-d', $timestamp);
    }

    private static function getMonthName($number)
    {
        $array = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];

        return $array[$number];
    }

    private static function getShortMonthName($number)
    {
        $array = [
            1 => 'янв',
            2 => 'фев',
            3 => 'мар',
            4 => 'апр',
            5 => 'май',
            6 => 'июн',
            7 => 'июл',
            8 => 'авг',
            9 => 'сен',
            10 => 'окт',
            11 => 'ноя',
            12 => 'дек',
        ];

        return $array[$number];
    }
}