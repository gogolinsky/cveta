<?php

use yii\bootstrap\ActiveForm;

/**
 * @var \app\modules\eav\models\EavAttributeOption $model
 * @var \app\modules\eav\models\EavAttribute $attribute
 */

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Добавить значение</h4>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'js-modal-form',
    'action' => ['/eav/backend/option-create', 'id' => $attribute->id],
    'method' => 'post',
    'options' => ['data-pjax' => ''],
]) ?>
    <div class="modal-body">
        <?= $form->field($model, 'value')->textInput(['autofocus' => true]) ?>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
    </div>
<?php ActiveForm::end() ?>
