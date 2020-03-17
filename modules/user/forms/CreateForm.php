<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;

/**
 * @property string $email
 * @property string $password
 */
class CreateForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            [['email', 'password'], 'trim'],
            [['email', 'password'], 'string', 'max' => 255],
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