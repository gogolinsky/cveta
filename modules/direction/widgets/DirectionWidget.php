<?php

namespace app\modules\direction\widgets;

use yii\base\Widget;

/**
 * @property \app\modules\direction\models\Direction $direction
 */
class DirectionWidget extends Widget
{
    public $direction;

    public function run()
    {
        return $this->render('direction', [
            'direction' => $this->direction,
        ]);
    }
}