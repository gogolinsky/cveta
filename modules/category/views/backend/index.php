<?php

use app\modules\category\helpers\CategoryHelper;
use app\modules\category\models\Category;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\category\models\CategorySearch $searchModel
 */

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'id' => 'pjax-widget'
        ],
    ],
    'striped' => false,
    'hover' => true,
    'panel' => [
        'after' => false,
    ],
    'toolbar' => [
        [
            'content' =>
                Html::a(
                    Icon::show('plus-outline') . ' Добавить категорию',
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
            'value' => function (Category $model) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $model->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $model->id], [
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
            'value' => function (Category $category) {
                return Html::img($category->getUploadedFileUrl('image'));
            },
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function (Category $category) {
                $indent = ($category->depth > 1 ? str_repeat('.', $category->depth - 1) . ' ' : '');
                return Html::a(
                    $indent . Html::encode($category->getTitle()),
                    ['/category/backend/update', 'id' => $category->id],
                    ['data-pjax' => '0']
                );
            },
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'alias',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'parent',
            'label' => 'Родительская категория',
            'filter' => CategoryHelper::getFilter(),
            'value' => function (Category $category) {
                /** @var \app\modules\category\models\Category $parent */
                $parent = $category->parents(1)->one();

                if (null !== $parent && $parent->getTitle()) {
                    return $parent->getTitle();
                }

                return null;
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
