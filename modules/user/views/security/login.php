<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \app\modules\user\forms\LoginForm $loginForm
 */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="login-box">
    <div class="login-logo">
        <h1>Авторизация</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Пожалуйста, авторизуйтесь</p>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-login'],
            'enableClientValidation' => false,
        ]) ?>

            <?= $form->field($loginForm, 'email', [
                'inputOptions' => ['autofocus' => 'autofocus'],
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>{error}'
            ]) ?>

            <?= $form->field($loginForm, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}'
            ])->passwordInput() ?>

            <div class="row">
                <div class="col-xs-8">
                    <?= $form->field($loginForm, 'rememberMe')->checkbox() ?>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
                </div>
            </div>

        <?php ActiveForm::end() ?>

        <?= Html::a('Восстановить пароль', ['/user/recovery/request']) ?>

    </div>
</div>
