<?php

use app\modules\product\helpers\ProductHelper;
use app\modules\product\models\Product;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\product\models\ProductSearch $searchModel
 */

$this->title = 'Товары';
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
        [
            'content' =>
                Html::a(
                    Icon::show('plus-outline') . ' Добавить',
                    ['create'],
                    [
                        'data-pjax' => 0,
                        'class' => 'btn btn-success'
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
    'columns' => [
        [
            'class' => DataColumn::class,
            'hAlign' => GridView::ALIGN_CENTER,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'id',
            'width' => '80px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'width' => '50px',
            'value' => function (Product $product) {
                return Html::img($product->getUploadedFileUrl('image'));
            },
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'code',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'attribute' => 'title',
            'value' => function (Product $product) {
                return Html::a($product->getTitle(), ['update', 'id' => $product->id], ['data-pjax' => '0']);
            }
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'parent',
            'label' => 'Категория',
            'filter' => ProductHelper::getFilterDropDown(),
            'value' => function (Product $product) {
                if (!empty($product->category)) {
                    return $product->category->getTitle();
                }

                return null;
            },
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'vendor_id',
            'label' => 'Производитель',
            'filter' => ProductHelper::getVendorList(),
            'value' => function (Product $product) {
                return !empty($product->vendor) ? $product->vendor->title : '-';
            },
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update}',
            'width' => '50px',
            'mergeHeader' => false,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-pencil"></i> Редактировать', $url, [
                        'class' => 'btn btn-xs btn-primary',
                        'data-pjax' => '0',
                    ]);
                },
            ],
        ],
    ],
]) ?>
