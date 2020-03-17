<?php

namespace app\modules\admin\widgets;

use yii\base\Widget;

/**
 * Class TableWidget
 * @property array $data
 */
class TableWidget extends Widget
{
    public $data;

    public function run()
    {
        return $this->render('table', ['data' => $this->data]);
    }
}