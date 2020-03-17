<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\setting\models\Setting $setting
 */

$this->title = 'Редактирование настройки';

?>

<?php if (Yii::$app->request->isAjax): ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?= $this->title ?></h4>
    </div>
    <?= $this->render('_form', compact('setting')); ?>
<?php else: ?>
    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', compact('setting')); ?>
        </div>
    </div>
<?php endif ?>