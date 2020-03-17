<?php

namespace app\modules\user\forms;

use app\modules\user\Mailer;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * @property string $email
 *
 * @property \app\modules\user\Module $module
 * @property \app\modules\user\Mailer $mailer
 */
class ForgetForm extends Model
{
    public $email;

    private $module;
    private $mailer;

    public function __construct($config = [])
    {
        $this->module = Yii::$app->getModule('user');
        $this->mailer = new Mailer();
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => User::class],
            ['email', function ($attribute) {
                $user = User::findOne(['email' => $this->email]);
                if ($user !== null && !$user->isConfirmed()) {
                    $this->addError($attribute, 'Вы должны активировать аккаунт');
                }
            }],
        ];
    }

    public function sendRecoveryMessage()
    {
        if (!$this->validate()) return false;

        $user = User::findOne(['email' => $this->email]);

        if (null == $user) return false;

        $token = new Token(['user_id' => $user->id, 'type' => Token::TYPE_RECOVERY]);
        $token->save();
        $this->mailer->sendRecoveryMessage($user, $token);
        Yii::$app->session->setFlash('info', 'Вам отправлено письмо с инструкциями по смене пароля');

        return true;
    }
}
