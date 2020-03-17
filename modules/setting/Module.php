<?php

namespace app\modules\setting;


use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
//        $app->get('mailer')->transport = array_filter([
//            'class' => 'Swift_SmtpTransport',
//            'host' => Settings::getSmtpHost(),
//            'username' => Settings::getNoReplyEmail(),
//            'password' => Settings::getSmtpPassword(),
//            'port' => Settings::getSmtpPort(),
//            'encryption' => Settings::getSmtpEncryption(),
//        ]);
    }
}
