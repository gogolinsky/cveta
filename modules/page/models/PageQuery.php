<?php

namespace app\modules\page\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @see Page
 */
class PageQuery extends ActiveQuery
{
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }

    public function openedByAlias()
    {
        return $this->andWhere(['route' =>  null]);
    }
}