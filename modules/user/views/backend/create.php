<?php

use yii\bootstrap\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \app\modules\user\forms\CreateForm $createForm
 */

$this->title = 'Добавление пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?= $form->field($createForm, 'email') ?>
            <?= $form->field($createForm, 'password') ?>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>

    <?php ActiveForm::end() ?>
</div>
