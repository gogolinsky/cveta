<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\user\forms\RegistrationForm $registrationForm
 */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="login-box">
    <div class="login-logo">
        <h1>Регистрация</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            Укажите данные для регистрации
        </p>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-login'],
            'enableClientValidation' => false,
        ]) ?>

        <?= $form->field($registrationForm, 'email', [
            'inputOptions' => ['autofocus' => 'autofocus'],
            'options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>{error}'
        ]) ?>

        <?= $form->field($registrationForm, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}'
        ])->passwordInput() ?>

        <div class="form-group clearfix">
            <button type="submit" class="btn btn-success btn-flat pull-right">Продолжить</button>
        </div>
        <?php ActiveForm::end() ?>
        <hr/>
        <?= Html::a('Не пришло письмо?', ['/user/registration/resend']) ?>
    </div>
</div>