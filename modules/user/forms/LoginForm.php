<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use app\modules\user\Module;
use Yii;
use yii\base\Model;
use app\modules\user\helpers\Password;

/**
 * @property string $email User's email
 * @property string $password User's plain password
 * @property bool $rememberMe
 *
 * @property User $user
 * @property Module $module
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $user;
    private $module;

    public function __construct($config = [])
    {
        $this->module = Yii::$app->getModule('user');
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            [['email', 'password'], 'trim'],

            ['password', function ($attribute) {
                if ($this->user === null || !Password::validate($this->password, $this->user->password_hash)) {
                    $this->addError($attribute, 'Неверный логин или пароль');
                }
            }],

            ['email', function ($attribute) {
                if ($this->user !== null) {
                    if (!$this->user->isConfirmed()) {
                        $this->addError($attribute, 'Вам необходимо подтвердить ваш email');
                    }
                }
            }],

            ['rememberMe', 'boolean'],
        ];
    }

    public function login()
    {
        if ($this->validate() && $this->user) {
            return Yii::$app->user->login($this->user, $this->rememberMe ? $this->module->rememberFor : 0);
        }

        return false;
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->user = User::find()->where(['email' => $this->email])->one();

            return true;
        }

        return false;
    }
}
