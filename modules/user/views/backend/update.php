<?php

use yii\bootstrap\Nav;
use yii\bootstrap\Tabs;

/**
 * @var \yii\web\View $this
 * @var string $content
 * @var \app\modules\user\models\User $user
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => array_filter([
            [
                'label' => 'Общее',
                'url' => ['/user/backend/update', 'id' => $user->id],
                'active' => Yii::$app->controller->action->id == 'update' && Yii::$app->controller->id == 'backend',
            ],
            [
                'label' => 'Сменить пароль',
                'url' => ['/user/backend/password-change', 'id' => $user->id],
                'active' => Yii::$app->controller->action->id == 'password-change' && Yii::$app->controller->id == 'backend',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить пользователя',
                        'url' => ['/user/backend/delete', 'id' => $user->id],
                        'linkOptions' => [
                            'class' => 'text-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы уверены?',
                        ],
                    ],
                ],
            ],
        ])
    ]) ?>

    <?= $content ?>

</div>
