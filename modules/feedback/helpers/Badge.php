<?php

namespace app\modules\feedback\helpers;

use app\modules\feedback\factories\FormFactory;
use app\modules\feedback\models\Feedback;

class Badge
{
    private static $badges = null;

    private static function getBadges() {

        if (is_null(self::$badges)) {
            self::$badges = [];
            foreach (FormFactory::$types as $type => $className) {
                self::$badges[$type] = Feedback::find()->where([
                    'type' => $type, 'status' => 1
                ])->select('id')->count();
            }
        }

        return self::$badges;
    }

    public static function getSum()
    {
        $badges = self::getBadges();
        return array_sum($badges);
    }

    /**
     * @param $type
     * @return int
     */
    public static function getCount($type)
    {
        $badges = self::getBadges();
        return !empty($badges[$type])? $badges[$type] : 0;
    }

    /**
     * @param $type
     * @return string
     */
    public static function getBadge($type)
    {
        $count = self::getCount($type);
        return !empty($count) ? '<span class="pull-right-container"><span class="label label-primary pull-right">' . $count . '</span></span>' : '';
    }

    public static function getSumBadge()
    {
        $count = self::getSum();

        return !empty($count) ? '<span class="pull-right-container"><span class="label label-primary pull-right">' . $count . '</span></span>' : '';
    }
}