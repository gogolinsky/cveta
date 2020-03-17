<?php

use app\modules\partner\models\Partner;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var \app\modules\partner\models\PartnerSearch $searchModel
 */

$this->title = 'Партнеры';
$this->params['breadcrumbs'][] = $this->title;

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
    'panel' => ['before'],
    'toolbar' => [
        ['content'=>
            Html::a(
                Icon::show('plus-outline') . 'Добавить',
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
            'attribute' => 'id',
            'width' => '80px',
            'vAlign' => GridView::ALIGN_MIDDLE,
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'value' => function (Partner $partner) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $partner->id], [
                        'class' => 'pjax-action'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $partner->id], [
                        'class' => 'pjax-action'
                    ]);
            },
            'format' => 'raw',
            'width' => '60px',
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'image',
            'format' => 'image',
            'width' => '100px',
            'vAlign' => GridView::ALIGN_MIDDLE,
            'label' => false,
            'value' => function (Partner $partner) {
                return $partner->getThumbFileUrl('image');
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'title',
            'vAlign' => GridView::ALIGN_MIDDLE,
            'format' => 'raw',
            'value' => function(Partner $partner) {
                return Html::a($partner->title, ['update', 'id' => $partner->id], ['data-pjax' => '0']);
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'link',
            'vAlign' => GridView::ALIGN_MIDDLE,
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
