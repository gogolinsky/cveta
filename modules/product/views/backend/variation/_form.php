<?php

use yii\bootstrap\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \app\modules\product\models\Variation $variation
 */

?>

<?php $form = ActiveForm::begin(['options' => ['id' => 'js-modal-form']]) ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?= $this->title ?></h4>
    </div>

    <div class="modal-body">
        <?= $form->field($variation, 'title') ?>
        <?= $form->field($variation, 'price')->textInput(['type' => 'number', 'step' => 'any']) ?>
        <?= $form->field($variation, 'volume') ?>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
    </div>
<?php ActiveForm::end() ?>
