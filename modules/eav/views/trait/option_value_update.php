<?php

use app\modules\eav\widgets\ActiveField;
use yii\bootstrap\ActiveForm;

/**
 * @var \app\modules\eav\models\EavAttributeValue $model
 * @var \app\modules\product\models\Product $entity
 */

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Редактирование атрибута</h4>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'js-modal-form',
    'action' => ['option-update', 'id' => $model->id],
    'method' => 'post',
    'options' => ['data-pjax' => '0'],
]) ?>
    <div class="modal-body">
        <?= $form->field($entity, $model->getEavAttribute()->one()->name, ['class' => ActiveField::class])->eavInput()->label($model->eavAttribute->title) ?>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
    </div>
<?php ActiveForm::end() ?>







