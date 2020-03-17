<?php

use app\modules\eav\models\EavAttribute;
use app\modules\eav\models\EavAttributeValue;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \app\modules\product\models\Product $product
 */

?>

<div class="box box-default box-solid ">
    <div class="box-header with-border">
        <h3 class="box-title">Характеристики</h3>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'bordered' => false,
            'layout' => "{items}{pager}",
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'pjax-widget']],
            'dataProvider' => new ActiveDataProvider([
                'query' => EavAttributeValue::find()
                    ->joinWith(['eavAttribute'])
                    ->where([EavAttributeValue::tableName().'.entity_id' => $product->id])
                    ->orderBy([EavAttribute::tableName().'.position' => SORT_ASC])
                    ->groupBy([EavAttribute::tableName().'.id']),
                'pagination' => ['defaultPageSize' => 50],
            ]),
            'export' => false,
            'tableOptions' => ['class' => 'table table-hover'],
            'summaryOptions' => ['class' => 'text-right'],
            'columns' => [
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'label' => 'Атрибут',
                    'value' => function($option) {
                        return $option->eavAttribute->title;
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'label' => 'Значение',
                    'value' => function($option) use ($product) {
                        return $product->{$option->eavAttribute->name}->getRealValue();
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'label' => 'Ед. изм.',
                    'value' => function($option) {
                        return $option->eavAttribute->unit;
                    }
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}',
                    'width' => '180px',
                    'mergeHeader' => false,
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a(
                                '<i class="fa fa-pencil"></i> Редактировать',
                                Url::to(['/product/backend/default/option-update', 'id' => $model->id]),
                                [
                                    'class' => 'btn btn-xs btn-primary',
                                    'data-pjax' => '0',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal'
                                ]
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            $url = Url::to(['/product/backend/default/option-delete', 'id' => $model->id]);

                            return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                'class' => 'btn btn-xs btn-danger btn-delete pjax-action',
                                'title' => 'Удалить',
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => 'Вы уверены?',
                            ]);
                        }
                    ]
                ],
            ],
        ]) ?>

        <div class="row">
            <div class="col-xs-12">
                <?= Html::a('Добавить атрибут', ['/product/backend/default/option-create', 'id' => $product->id], [
                    'class' => 'btn btn-sm btn-primary pull-right',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                ]) ?>
            </div>
        </div>
    </div>
</div>


