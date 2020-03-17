<?php

use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\icons\Icon;
use kartik\grid\GridView;
use app\modules\setting\models\Setting;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * @var \yii\web\View $this
 * @var app\modules\setting\models\SettingSearch $searchModel
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
];

?>

<?= GridView::widget([

    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'pjax-widget']],
    'bordered' => false,
    'striped' => false,
    'hover' => true,

    'panel' => [
        'before',
    ],
    'toolbar' => !YII_ENV_DEV ? false : [
        ['content'=>
            Html::a(
                Icon::show('plus-outline') . 'Добавить',
                ['create'],
                [
                    'data-pjax' => 0,
                    'class' => 'btn btn-success',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                ]
            ) . ' '.
            Html::a(
                Icon::show('arrow-sync-outline'),
                ['index'],
                [
                    'data-pjax' => 0,
                    'class' => 'btn btn-default',
                ]
            )
        ],
        '{toggleData}',
    ],
    'toggleDataOptions' => [
        'all' => [
            'icon' => 'resize-full',
            'label' => 'Показать все',
            'class' => 'btn btn-default',
            'title' => 'Показать все'
        ],
        'page' => [
            'icon' => 'resize-small',
            'label' => 'Страницы',
            'class' => 'btn btn-default',
            'title' => 'Постаничная разбивка'
        ],
    ],
    'export' => false,
    'columns' => array_filter([
        !YII_ENV_DEV ? [] : [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'value' => function (Setting $setting) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $setting->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $setting->id], [
                        'class' => 'pjax-action'
                    ]);
            },
            'format' => 'raw',
            'width' => '60px',
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'id',
            'vAlign' => GridView::ALIGN_MIDDLE,
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'title',
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'value' => function(Setting $setting) {
                return Html::a($setting->title, ['update', 'id' => $setting->id], [
                    'data-pjax' => '0',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-lg',
                ]);
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'value',
            'format' => 'ntext',
            'vAlign' => GridView::ALIGN_MIDDLE,
            'value' => function(Setting $setting) {
                return $setting->value;
            }
        ],
        [
            'class' => ActionColumn::class,
            'template' => YII_ENV_DEV ? '{update}&nbsp;{delete}' : '{update}',
            'width' => '150px',
            'mergeHeader' => false,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-pencil"></i> Редактировать', $url, [
                        'class' => 'btn btn-xs btn-primary',
                        'data-pjax' => '0',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-lg',
                    ]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="fa fa-trash-o"></i>',
                        $url,
                        [
                            'class' => 'btn btn-xs btn-danger btn-delete pjax-action',
                            'title' => 'Удалить',
                            'data-confirm' => 'Вы уверены?',
                        ]
                    );
                },
            ],
        ],
    ]),
]) ?>