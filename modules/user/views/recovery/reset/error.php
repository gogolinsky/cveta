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
            Ссылка для смены пароля неправильна или устарела. Пожалуйста, попробуйте запросить новую ссылку.
        </p>
        <a href="<?= Url::to(['/user/recovery/request']) ?>" class="btn btn-primary btn-flat pull-right">Восстановить пароль заново</a>
    </div>
</div>
