<?php

namespace app\modules\user\repositories;

use app\modules\user\models\User;
use DomainException;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function findById($id): User
    {
        $user = User::findOne($id);

        if (null === $user) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $user;
    }

    public function findByToken($token): User
    {
        $user = User::find()->joinWith(['tokens'])->where(['tokens.code' => $token])->one();

        if (null == $user) {
            throw new DomainException('User for this token does not exists');
        }

        return $user;
    }

    public function findByEmail($email): User
    {
        $user = User::findOne(['email' => $email]);

        if (null == $user) {
            throw new DomainException("User with email $email does not exists");
        }

        return $user;
    }
}