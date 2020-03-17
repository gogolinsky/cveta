<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\user\forms\ResendForm $resendForm
 */

$this->title = 'Запрос подтверждения email';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="login-box">
    <div class="login-logo">
        <h1>Восстановление пароля</h1>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Введите email, указанный вами при регистрации.<br>
            На него еще раз придет письмо с ссылкой для подтверждения.</p>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-login'],
            'enableClientValidation' => false,
        ]) ?>

        <?= $form->field($resendForm, 'email', [
            'inputOptions' => ['autofocus' => 'autofocus'],
            'options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>{error}'
        ]) ?>

        <div class="row">
            <div class="col-xs-8">

            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Продолжить</button>
            </div>
        </div>

        <?php ActiveForm::end() ?>

        <?= Html::a('Восстановить пароль', ['/user/recovery/request']) ?>

    </div>
</div>