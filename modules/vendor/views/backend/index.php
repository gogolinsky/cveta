<?php

use app\modules\vendor\models\Vendor;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\vendor\models\VendorSearch $searchModel
 */

$this->title = 'Производители';
$this->params['breadcrumbs'][] = $this->title;

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
                    'data-pjax' => '0',
                    'class' => 'btn btn-success',
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
            'width' => '50px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'value' => function (Vendor $vendor) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $vendor->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $vendor->id], [
                        'class' => 'pjax-action'
                    ]);
            },
            'format' => 'raw',
            'width' => '60px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'width' => '50px',
            'value' => function (Vendor $vendor) {
                return Html::img($vendor->getUploadedFileUrl('image'));
            },
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function (Vendor $vendor) {
                return Html::a(
                    $vendor->title, ['/vendor/backend/update', 'id' => $vendor->id], [
                    'data-pjax' => '0',
                ]);
            }
        ],
        'alias',
        [
            'class' => ActionColumn::class,
            'template' => '{update}',
            'width' => '200px',
            'mergeHeader' => false,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="fa fa-pencil"></i> Редактировать', $url, [
                        'class' => 'btn btn-xs btn-primary',
                        'data-pjax' => '0',
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
