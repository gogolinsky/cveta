<?php

namespace app\modules\setting\models;

use yii\db\ActiveQuery;

/**
 * @property string $type
 */
class SettingQuery extends ActiveQuery
{
    public $type;

    public function prepare($builder)
    {
        if ($this->type !== null) {
            $this->andWhere(["type" => $this->type]);
        }
        return parent::prepare($builder);
    }
}