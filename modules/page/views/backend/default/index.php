<?php

use app\modules\page\helpers\PageHelper;
use app\modules\page\models\Page;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\page\models\PageSearch $searchModel
 */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'grid']],
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
            'width' => '100px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function(Page $page) {
                return Html::a(PageHelper::getNestedSetTitle($page->title, $page->depth), ['/page/backend/default/update', 'id' => $page->id], [
                    'data-pjax' => '0',
                ]);
            }
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'attribute' => 'alias',
            'label' => 'Алиас',
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'parent',
            'label' => 'Родительская страница',
            'filter' => PageHelper::getFilter(),
            'value' => function (Page $page) {
                if ($page->parents(1)->exists()) {
                    return $page->parents(1)->one()->title;
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
