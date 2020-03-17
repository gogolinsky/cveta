<?php

namespace app\modules\user\forms;

use app\modules\user\models\Token;
use Yii;
use yii\base\Model;

/**
 * @property string $password
 */
class RecoveryForm extends Model
{
    public $password;

    public function attributeLabels()
    {
        return [
            'password' => 'Новый пароль',
        ];
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string'],
        ];
    }

    public function resetPassword(Token $token)
    {
        if (!$this->validate() || $token->user === null) {
            return false;
        }

        if ($token->user->resetPassword($this->password)) {
            Yii::$app->session->setFlash('success', 'Пароль был успешно изменен');
            $token->delete();
        } else {
            Yii::$app->session->setFlash('danger', 'Во время смены пароля произошла ошибка. Пожалуйста, повторите попытку позднее');
        }

        return true;
    }
}
