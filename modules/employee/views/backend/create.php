<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\employee\models\Employee $employee
*/

$this->title = 'Добавление сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('employee')) ?>
</div>