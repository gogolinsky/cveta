<?php

namespace app\modules\employee\widgets;

use yii\base\Widget;

/**
 * @property \app\modules\employee\models\Employee $employee
 */
class EmployeeWidget extends Widget
{
    public $employee;

    public function run()
    {
        return $this->render('employee', [
            'employee' => $this->employee,
        ]);
    }
}