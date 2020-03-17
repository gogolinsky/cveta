<?php

namespace app\modules\eav\models;

use yii\db\ActiveQuery;

class EavAttributeQuery extends ActiveQuery
{
    public function important()
    {
        return $this->andWhere(['is_important' => 1]);
    }

    public function inFilter()
    {
        return $this->andWhere(['in_filter' => 1]);
    }
}
