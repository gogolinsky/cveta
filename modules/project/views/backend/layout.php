<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var string $content
 * @var \app\modules\project\models\Project $project
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'options' => ['class' => 'pull-left'],
                'label' => 'Общее',
                'url' => ['/project/backend/default/update', 'id' => $project->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [

                'label' => 'Отзыв',
                'url' => ['/project/backend/default/review', 'id' => $project->id],
                'active' => Yii::$app->controller->action->id == 'review',
            ],
            [

                'label' => 'SEO',
                'url' => ['/project/backend/default/seo', 'id' => $project->id],
                'active' => Yii::$app->controller->action->id == 'seo',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить',
                        'url' => ['/project/backend/default/delete', 'id' => $project->id],
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