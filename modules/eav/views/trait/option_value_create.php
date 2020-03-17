<?php

use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/**
 * @var \app\modules\eav\models\EavAttributeValue $model
 * @var \app\modules\product\models\Product $entity
 * @var array $data
 */

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Добавление атрибута</h4>
</div>

<?php if (empty($data)): ?>
    <div class="modal-body">
        <p>Нет свободных атрибутов</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
<?php else: ?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjax-form']) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'js-modal-form',
        'action' => Url::toRoute(['option-create', 'id' => $entity->id]),
        'method' => 'post',
        'options' => ['data-pjax' => ''],
    ]) ?>
        <div class="modal-body">
            <?= $form->field($model, 'attribute_id')->widget(Select2::className(), [
                'data' => $data,
                'theme' => Select2::THEME_BOOTSTRAP,
                'pluginOptions' => [
                    'allowClear' => false,
                ],
            ]) ?>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="submit">Сохранить</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        </div>
    <?php ActiveForm::end() ?>
<?php \yii\widgets\Pjax::end()?>
<?php endif; ?>
