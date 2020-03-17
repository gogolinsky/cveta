<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\modules\user\forms\RecoveryForm $recoveryForm
 */

$this->title = 'Сбросить пароль';

?>

<div class="login-box">
    <div class="login-logo">
        <h1 style="font-size: 30px">Сбросить пароль</h1>
    </div>
    <div class="login-box-body clearfix">

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-login'],
            'enableClientValidation' => false,
        ]) ?>

            <?= $form->field($recoveryForm, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}'
            ])->passwordInput() ?>

            <button type="submit" class="btn btn-primary btn-flat pull-right">Продолжить</button>

        <?php ActiveForm::end() ?>
    </div>
</div>