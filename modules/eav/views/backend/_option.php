<?php

use yii\bootstrap\ActiveForm;

/**
 * @var \app\modules\eav\models\EavAttributeOption $model
 */

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Редактировать значение</h4>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'option-update-form',
    'action' => ['/eav/backend/option-update', 'id' => $model->id],
    'method' => 'post',
    'options' => ['data-pjax' => ''],
]) ?>
    <div class="modal-body">
        <?= $form->field($model, 'value')->textInput(['autofocus' => true])->label($model->eavAttribute->title) ?>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
    </div>
<?php ActiveForm::end() ?>
