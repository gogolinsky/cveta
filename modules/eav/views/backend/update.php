<?php

use yii\bootstrap\Nav;

/**
 * @var string $content
 * @var yii\web\View $this
 * @var app\modules\eav\models\EavAttribute $model
 */

?>

<div class="row">
    <div class="col-xs-10">
        <?= $content ?>
    </div>
    <div class="col-xs-2">
        <?= Nav::widget([
            'options' => [
                'class' => 'nav-pills nav-stacked',
            ],
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => 'Общее',
                    'url' => ['/eav/backend/update', 'id' => $model->id]
                ],
                [
                    'label' => 'Значения',
                    'url' => ['/eav/backend/options', 'id' => $model->id],
                    'visible' => in_array($model->type_id, [2, 3, 5]),
                ],
                [
                    'label' => 'Действия',
                    'items' => [
                        [
                            'label' => 'Удалить',
                            'url' => ['/eav/backend/delete', 'id' => $model->id],
                            'linkOptions' => [
                                'class' => 'text-danger',
                                'data-method' => 'post',
                                'data-confirm' => 'Вы уверены?',
                            ],
                        ],
                    ],
                ],
            ],
        ]) ?>
    </div>
</div>
