<?php

namespace app\modules\user;

use app\modules\settings\models\Settings;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use Yii;
use yii\base\Component;

/**
 * @property string $noReplyEmail
 * @property string $viewPath
 * @property string $welcomeSubject
 * @property string $confirmationSubject
 * @property string $reconfirmationSubject
 * @property string $recoverySubject
 */
class Mailer extends Component
{
    public $viewPath = '@app/modules/user/views/mail';
    public $welcomeSubject;
    public $confirmationSubject;
    public $reconfirmationSubject;
    public $recoverySubject;

    public function sendWelcomeMessage(User $user, string $password)
    {
        return $this->sendMessage($user->email, $this->welcomeSubject, 'welcome', compact('user', 'password'));
    }

    public function sendConfirmationMessage(User $user, Token $token)
    {
        return $this->sendMessage($user->email, $this->confirmationSubject, 'confirmation', compact('user', 'token'));
    }

    public function sendReconfirmationMessage(User $user, Token $token)
    {
        if ($token->type == Token::TYPE_CONFIRM_NEW_EMAIL) {
            $email = $user->unconfirmed_email;
        } else {
            $email = $user->email;
        }

        return $this->sendMessage($email, $this->reconfirmationSubject, 'reconfirmation', compact('user', 'token'));
    }

    public function sendRecoveryMessage(User $user, Token $token)
    {
        return $this->sendMessage($user->email, $this->recoverySubject, 'recovery', compact('user', 'token'));
    }

    private function sendMessage($to, $subject, $view, $params = [])
    {
        /** @var \yii\swiftmailer\Mailer $mailer */
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = $this->viewPath;
        $from = [Yii::$app->params['email_from']];

        $message = $mailer->compose(['html' => $view, 'text' => "text/$view"], $params)
            ->setTo($to)
            ->setFrom($from)
            ->setSubject($subject);

        return $message->send();
    }
}
