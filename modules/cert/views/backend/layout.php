<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var string $content
 * @var \app\modules\cert\models\Cert $cert
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'options' => ['class' => 'pull-left'],
                'label' => 'Общее',
                'url' => ['/cert/backend/default/update', 'id' => $cert->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить',
                        'url' => ['/cert/backend/default/delete', 'id' => $cert->id],
                        'linkOptions' => [
                            'class' => 'text-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы уверены?',
                        ],
                    ],
                ],
            ],
        ]
    ]) ?>

    <?= $content ?>
</div>