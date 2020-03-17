<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \app\modules\user\forms\ForgetForm $forgetForm
 */

$this->title = 'Сбросить пароль';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="login-box">
    <div class="login-logo">
        <h1 style="font-size: 30px">Восстановление пароля</h1>
    </div>
    <div class="login-box-body clearfix">

        <p class="login-box-msg">
            Введите email, указанный при регистрации.
            На него вам придет письмо с ссылкой на восстановление пароля.
        </p>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-login'],
            'enableClientValidation' => false,
        ]) ?>

        <?= $form->field($forgetForm, 'email', [
            'inputOptions' => ['autofocus' => 'autofocus'],
            'options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>{error}'
        ]) ?>

        <button type="submit" class="btn btn-primary btn-flat pull-right">Продолжить</button>

        <?php ActiveForm::end() ?>
    </div>
</div>
