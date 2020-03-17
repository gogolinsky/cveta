<?php

use app\modules\eav\models\EavAttributeOption;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\modules\eav\models\EavAttribute $model
 */

$this->title = 'Обновить ' . $model->getLabel();
$this->params['breadcrumbs'][] = ['label' => 'Аттрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->getLabel();

?>

<?php $this->beginContent('@app/modules/eav/views/backend/update.php', compact('model')) ?>

    <?= GridView::widget([
        'bordered' => false,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'pjax-widget',
            ],
        ],
        'dataProvider' => new ActiveDataProvider([
            'query' => EavAttributeOption::find()->where(['attribute_id' => $model->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]),
        'tableOptions' => ['class' => 'table table-hover'],
        'summaryOptions' => ['class' => 'text-right'],
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
                'attribute' => 'value',
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
                'width' => '150px',
                'mergeHeader' => false,
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            'Редактировать',
                            Url::to(['/eav/backend/option-update', 'id' => $model->id]),
                            [
                                'title' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                                'data-toggle' => 'modal',
                                'data-target' => '#modal',
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = Url::to(['/eav/backend/option-delete', 'id' => $model->id]);

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'class' => 'text-danger pjax-action',
                            'data-confirm' => 'Вы уверены?',
                            'data-method' => 'post',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

    <div class="row">
        <div class="col-xs-2 col-xs-offset-10">
            <?= Html::a('Добавить', ['/eav/backend/option-create', 'id' => $model->id], [
                'class' => 'btn btn-primary btn-xs btn-block',
                'data-toggle' => 'modal',
                'data-target' => '#modal',
            ]) ?>
        </div>
    </div>
<?php $this->endContent(); ?>

