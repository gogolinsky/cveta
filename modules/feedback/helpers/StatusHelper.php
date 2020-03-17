<?php

namespace app\modules\feedback\helpers;

use app\modules\feedback\models\Feedback;

class StatusHelper
{
    public static function getStatusList()
    {
        return [
            Feedback::STATUS_NEW => 'Новый',
            Feedback::STATUS_PROCESS => 'В обработке',
            Feedback::STATUS_SUCCESS => 'Обработан',
            Feedback::STATUS_CANCELED => 'Отменен',
        ];
    }

    public static function getStatusClasses()
    {
        return [
            Feedback::STATUS_NEW => 'danger',
            Feedback::STATUS_PROCESS => 'info',
            Feedback::STATUS_SUCCESS => 'success',
            Feedback::STATUS_CANCELED => 'default',
        ];
    }

    public static function getStatusText($status)
    {
        return self::getStatusList()[$status];
    }

    public static function getStatusClass($status)
    {
        return self::getStatusClasses()[$status];
    }

    public static function getStatusHtml($status)
    {
        return '<span class="label label-' . self::getStatusClass($status) . '">' . self::getStatusText($status) . '</span>';
    }
}