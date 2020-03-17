<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var string $content
 * @var \app\modules\service\models\Service $service
 */

?>
<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'options' => ['class' => 'pull-left'],
                'label' => 'Общее',
                'url' => ['update', 'id' => $service->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [

                'label' => 'SEO',
                'url' => ['seo', 'id' => $service->id],
                'active' => Yii::$app->controller->action->id == 'seo',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить',
                        'url' => ['delete', 'id' => $service->id],
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