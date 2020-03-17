<?php

namespace app\modules\product\widgets;

use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * @property ActiveDataProvider $dataProvider
 */
class ListWidget extends Widget
{
    public $dataProvider;

    public function run()
    {
        return $this->render('list', ['dataProvider' => $this->dataProvider]);
    }
}
