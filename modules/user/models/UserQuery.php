<?php

namespace app\modules\user\models;

use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['blocked_at' => null]);
    }
}