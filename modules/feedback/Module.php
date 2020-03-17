<?php

namespace app\modules\feedback;

use app\modules\feedback\models\Feedback;
use app\modules\setting\components\Settings;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Event::on(Feedback::class, ActiveRecord::EVENT_AFTER_INSERT, [$this, 'notify']);

        $app->get('urlManager')->rules[] = new GroupUrlRule([
            'rules' => [
                '/feedback/send' => '/feedback/frontend/send',
                '/feedback/success' => '/feedback/frontend/success',
                '/feedback/error' => '/feedback/frontend/error',
            ],
        ]);
    }

    public function notify(Event $event)
    {
        /** @var Feedback $feedback */
        $feedback = $event->sender;
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = '@app/modules/feedback/views/mail';
        $mailer->compose(['html' => 'manager'], compact('feedback'))
            ->setTo(Settings::getArray('mail_to'))
            ->setFrom([Yii::$app->params['email_from'] => 'Мастерская цвета'])
            ->setSubject('Заявка: ' . $feedback::TITLE)
            ->send();
    }
}
