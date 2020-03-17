<?php

namespace app\modules\feedback\factories;

use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\forms\HelpForm;
use app\modules\feedback\forms\OrderForm;
use app\modules\feedback\models\Feedback;
use Exception;

class FormFactory
{
    public static $types = [
        CallbackForm::TYPE => CallbackForm::class,
        OrderForm::TYPE => OrderForm::class,
        HelpForm::TYPE => HelpForm::class,
    ];

    public static function create($type): Feedback
    {
        $className = self::getClassName($type);
        return new $className();
    }

    public static function getClassName($type)
    {
        if (empty(self::$types[$type])) {
            throw new Exception();
        }

        return self::$types[$type];
    }
}