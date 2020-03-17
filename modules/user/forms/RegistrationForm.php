<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use app\modules\user\traits\ModuleTrait;
use yii\base\Model;

/**
 * @property string $email
 * @property string $password
 *
 * @property \app\modules\user\Module $module
 */
class RegistrationForm extends Model
{
    use ModuleTrait;

    public $email;
    public $password;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Этот email уже занят'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 72],
            ['password', 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }
}
