<?php

use yii\helpers\Url;

/**
 * @var yii\web\View $this
 */

$this->title = 'Сбросить пароль';

?>

<div class="login-box">
    <div class="login-logo">
        <h1 style="font-size: 30px">Сбросить пароль</h1>
    </div>
    <div class="login-box-body clearfix">
        <p class="login-box-msg">
            Пароль успешно изменен. Мы можете авторизироваться на сайте с новым паролем.
        </p>
        <a href="<?= Url::to(['/user/security/login']) ?>" class="btn btn-primary btn-flat pull-right">Войти</a>
    </div>
</div>
