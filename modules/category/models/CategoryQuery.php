<?php

namespace app\modules\category\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @mixin NestedSetsQueryBehavior
 */
class CategoryQuery extends ActiveQuery
{
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }
}
