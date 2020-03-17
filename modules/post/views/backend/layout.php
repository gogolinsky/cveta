<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var string $content
 * @var \app\modules\post\models\Post $post
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'options' => ['class' => 'pull-left'],
                'label' => 'Общее',
                'url' => ['/post/backend/default/update', 'id' => $post->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [

                'label' => 'SEO',
                'url' => ['/post/backend/default/seo', 'id' => $post->id],
                'active' => Yii::$app->controller->action->id == 'seo',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить',
                        'url' => ['/post/backend/default/delete', 'id' => $post->id],
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