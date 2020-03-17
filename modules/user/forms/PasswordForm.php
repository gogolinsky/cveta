<?php

namespace app\modules\user\forms;

use app\modules\user\helpers\Password;
use app\modules\user\models\User;
use yii\base\Model;

/**
 * @property string $password
 * @property string $password_repeat
 */
class PasswordForm extends Model
{
    public $password;
    public $password_repeat;

    /** @var User */
    private $user;

    public function __construct($user, $config = [])
    {
        $this->user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'trim'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }

    public function change()
    {
        if (!$this->validate()) return false;

        return (bool) $this->user->updateAttributes(['password_hash' => Password::hash($this->password)]);
    }
}
