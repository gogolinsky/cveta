<?php

/**
 * @var app\modules\user\models\User $user
 * @var string $password
 */
?>

Здравствуйте,

Ваш аккаунт на сайте "<?= Yii::$app->name ?>" был успешно создан.
Вы можете использовать его вместе с вашим email для входа.

Email: <?= $user->email ?>
Пароль: <?= $password ?>
P.S. Если вы получили это сообщение по ошибке, просто удалите его.
