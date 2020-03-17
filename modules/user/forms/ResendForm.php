<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;

/**
 * @property string $email
 */
class ResendForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => User::class, 'message' => 'Нет такого email в базе'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }
}
