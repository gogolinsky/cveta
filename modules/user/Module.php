<?php

namespace app\modules\user;

use yii\base\Module as BaseModule;

/**
 * @property bool $enableRegistration
 * @property bool $enableGeneratingPassword
 * @property int $rememberFor
 * @property int $confirmWithin
 * @property int $recoverWithin
 */
class Module extends BaseModule
{
    public $enableRegistration = true;
    public $enableGeneratingPassword = true;
    public $rememberFor = 1209600; // 60 * 60 * 24 * 14; // two weeks
    public $confirmWithin = 86400; //60 * 60 * 24; // 24 hours
    public $recoverWithin = 21600; //60 * 60 * 6; // 6 hours

    /** @var array Mailer configuration */
    public $mailer = [];

    public $urlRules = [
        '/<action:(login|logout)>' => '/user/security/<action>',
        '/registration' => '/user/registration/index',
        '/resend' => '/user/registration/resend',
        '/registration/confirm/<token>' => '/user/registration/confirm',
        '/forgot' => '/user/recovery/request',
        '/recovery/<id:\d+>/<code:\w+>' => '/user/recovery/reset',
    ];
}
