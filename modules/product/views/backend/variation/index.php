<?php

use app\modules\product\models\Variation;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\product\models\VariationSearch $searchModel
 * @var \app\modules\product\models\Product $product
 */

?>

<?php $this->beginContent('@app/modules/product/views/backend/default/layout.php', ['product' => $product, 'breadcrumbs' => ['Вариации']]); ?>

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
        [
            'content' =>
                Html::a(
                    Icon::show('plus-outline') . ' Добавить',
                    ['create', 'id' => $product->id],
                    [
                        'data-pjax' => 0,
                        'class' => 'btn btn-success',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                    ]
                ) . ' ' .
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
    'export' => false,
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
            'value' => function (Variation $variation) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $variation->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $variation->id], [
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
            'attribute' => 'price',
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update}&nbsp;{delete}',
            'width' => '200px',
            'mergeHeader' => false,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="fa fa-pencil"></i> Редактировать', $url, [
                        'class' => 'btn btn-xs btn-primary',
                        'data-toggle' => 'modal',
                        'data-pjax' => '0',
                        'data-target' => '#modal-lg'
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
    ],
]) ?>

<?php $this->endContent() ?>
