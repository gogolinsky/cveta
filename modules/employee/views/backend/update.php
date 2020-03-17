<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\employee\models\Employee $employee
 */

$this->title = 'Редактирование сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $employee->getTitle()];

?>

<?php $this->beginContent('@app/modules/employee/views/backend/layout.php', compact('employee')) ?>

<?= $this->render('_form', compact('employee')) ?>

<?php $this->endContent() ?>