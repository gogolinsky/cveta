<?php

namespace app\modules\eav;

use yii\db\ActiveRecord;

/**
 * Class EavTrait
 * @package app\modules\eav
 *
 * @mixin ActiveRecord
 */
trait EavTrait
{
    /**
     * @param $attribute
     * @return mixed
     */
    public function getAttributeLabel($attribute)
    {
        $labels = $this->attributeLabels();

        if (!isset($labels[$attribute])) {
            $label = $this->getLabel($attribute);

            if ($label) {
                $labels[$attribute] = $label;
            }
        }

        return isset($labels[$attribute]) ? $labels[$attribute] : $this->generateAttributeLabel($attribute);
    }

}