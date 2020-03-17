<?php

use app\modules\feedback\helpers\StatusHelper;
use app\modules\feedback\models\Feedback;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;

/**
 * @var \yii\web\View $this
 * @var Feedback $feedback
 */

 ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Просмотр заявки</h4>
</div>
<?php $form = ActiveForm::begin(['options' => ['id' => 'js-modal-form']]) ?>
<div class="modal-body">

    <?= $form->field($feedback, 'status')->dropDownList(StatusHelper::getStatusList()) ?>

    <?= DetailView::widget([
        'model' => $feedback,
        'attributes' => [
            'id',
            [
                'attribute' => 'type',
                'value' => $feedback::TITLE,
            ],
            [
                'attribute' => 'name',
                'visible' => !empty($feedback->name),
            ],
            [
                'attribute' => 'phone',
                'visible' => !empty($feedback->phone),
            ],
            [
                'attribute' => 'comment',
                'format' => 'ntext',
                'visible' => !empty($feedback->comment),
            ],
            [
                'attribute' => 'ref',
                'format' => 'raw',
                'visible' => !empty($feedback->ref),
                'value' => Html::a($feedback->ref, $feedback->ref, ['target' => '_blank'])
            ],
            [
                'attribute' => 'created_at',
                'visible' => !empty($feedback->created_at),
                'format' => 'datetime',
            ],
        ],
    ]) ?>
</div>
<div class="modal-footer">
    <button class="btn btn-success">Сохранить</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
</div>
<?php ActiveForm::end() ?>

