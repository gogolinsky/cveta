<?php

namespace app\modules\user\services;

use app\modules\user\forms\CreateForm;
use app\modules\user\helpers\Password;
use app\modules\user\helpers\Rbac;
use app\modules\user\Mailer;
use app\modules\user\forms\ResendForm;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use app\modules\user\Module;
use app\modules\user\forms\RegistrationForm;
use app\modules\user\repositories\UserRepository;
use Throwable;
use Yii;

/**
 * @property RoleManager $roles
 * @property Module $module
 * @property Mailer $mailer
 * @property UserRepository $users
 */
class UserService
{
    private $module;
    private $roles;
    private $mailer;
    private $users;

    public function __construct(RoleManager $roles, Mailer $mailer, UserRepository $users)
    {
        $this->roles = $roles;
        $this->mailer = $mailer;
        $this->module = Yii::$app->getModule('user');
        $this->users = $users;
    }

    public function create(CreateForm $form): User
    {
        $password = $this->module->enableGeneratingPassword && null == $form->password ? Password::generate(8) : $form->password;
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $user = User::create($form->email, $password);
            $this->roles->assign($user->id, Rbac::ROLE_ADMINISTRATOR);
            $this->mailer->sendWelcomeMessage($user, $password);
            $transaction->commit();
            return $user;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function register(RegistrationForm $form): void
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $password = $this->module->enableGeneratingPassword && null == $form->password ? Password::generate(8) : $form->password;
            $user = User::register($form->email, $password);
            $this->roles->assign($user->id, Rbac::ROLE_USER);

            $token = new Token(['type' => Token::TYPE_CONFIRMATION]);
            $token->link('user', $user);

            $this->mailer->sendConfirmationMessage($user, isset($token) ? $token : null);

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function confirm(User $user): void
    {
        $user->confirm();
    }

    public function resend(ResendForm $form): void
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $user = $this->users->findByEmail($form->email);
            Token::deleteAll(['user_id' => $user->id, 'type' => Token::TYPE_CONFIRMATION]);
            $token = new Token(['type' => Token::TYPE_CONFIRMATION]);
            $token->link('user', $user);

            $this->mailer->sendConfirmationMessage($user, isset($token) ? $token : null);

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}