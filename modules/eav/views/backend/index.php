<?php

use app\modules\eav\models\EavAttribute;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\eav\models\EavAttributeSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Аттрибуты';
$this->params['breadcrumbs'][] = 'Аттрибуты';

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'pjax-widget']],
    'striped' => false,
    'hover' => true,
    'panel' => [
        'before',
        'after' => false,
    ],
    'toolbar' => [
        ['content'=>
            Html::a(
                Icon::show('plus-outline') . ' Добавить',
                ['create'],
                [
                    'data-pjax' => 0,
                    'class' => 'btn btn-success'
                ]
            ) . ' '.
            Html::a(
                Icon::show('arrow-sync-outline'),
                ['index'],
                [
                    'data-pjax' => 0,
                    'class' => 'btn btn-default',
                    'title' => Yii::t('app', 'Reset')
                ]
            )
        ],
        '{toggleData}',
        '{export}',
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
    'columns' => [
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'id',
            'width' => '80px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'label' => 'Порядок',
            'value' => function (EavAttribute $eavAttribute) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $eavAttribute->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $eavAttribute->id], [
                        'class' => 'pjax-action'
                    ]);
            },
            'format' => 'raw',
            'width' => '60px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'title',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'name',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'label',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'unit',
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update}',
            'width' => '50px',
            'mergeHeader' => false,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        'Редактировать',
                        $url,
                        [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]
                    );
                },
            ],
        ],
    ],
]) ?>
