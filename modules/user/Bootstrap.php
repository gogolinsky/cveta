<?php

namespace app\modules\user;

use app\modules\user\models\User;
use Yii;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->hasModule('user') && ($module = $app->getModule('user')) instanceof Module) {
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'app\modules\user\commands';
            } else {
                Yii::$container->set(\yii\web\User::class, [
                    'enableAutoLogin' => true,
                    'loginUrl' => ['/user/security/login'],
                    'identityClass' => User::class,
                ]);

                $app->get('urlManager')->rules[] = new GroupUrlRule(['rules' => $module->urlRules]);
            }

            $defaults = [
                'welcomeSubject' => 'Добро пожаловать на ' . Yii::$app->name,
                'confirmationSubject' => 'Активация аккаунта на сайте ' . Yii::$app->name,
                'reconfirmationSubject' => 'Смена почтового адреса на сайте ' . Yii::$app->name,
                'recoverySubject' => 'Смена пароля на сайте ' . Yii::$app->name,
            ];

            Yii::$container->set(Mailer::class, array_merge($defaults, $module->mailer));
        }
    }
}
