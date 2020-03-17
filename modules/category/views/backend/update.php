<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var \app\modules\category\models\Category $category
 * @var string $content
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['/category/backend/update', 'id' => $category->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'SEO',
                'url' => ['/category/backend/seo', 'id' => $category->id],
                'active' => Yii::$app->controller->action->id == 'seo',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить категорию',
                        'url' => ['/category/backend/delete', 'id' => $category->id],
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