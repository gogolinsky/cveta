<?php

use app\modules\feedback\helpers\FeedbackHelper;
use app\modules\feedback\models\Feedback;
use kartik\grid\GridView;
use dmstr\widgets\Menu;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\feedback\models\FeedbackSearch $searchModel
 * @var Feedback $instanceForm
 */

?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Заявки</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <?= Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked', 'data-widget' => 'tree'],
                    'encodeLabels' => false,
                    'items' => FeedbackHelper::getMenuItems(),
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
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
                'heading'=>'<h3 class="panel-title"><i class="fa fa-' . $instanceForm::ICON . '"></i> ' . $instanceForm::TITLE . '</h3>',
                'before' => false,
                'after' => false,
            ],
            'export' => false,
            'columns' => FeedbackHelper::getGridColumns($instanceForm->gridAttrs()),
        ]) ?>
    </div>
</div>
