<?php

use mihaildev\ckeditor\CKEditor;
use yii\base\ViewNotFoundException;
use kartik\form\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\page\models\Page $page
 * @var array $dropDownArray
 * @var array $dropDownOptionsArray
 */

?>

<?php $this->beginContent('@app/modules/page/views/backend/layout.php', compact('page')) ?>

<?php $form = ActiveForm::begin() ?>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-4">
                <?= $form->field($page, 'parent_id')->dropDownList($dropDownArray, $dropDownOptionsArray) ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($page, 'id')->textInput(['disabled' => true]) ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($page, 'route'); ?>
            </div>
        </div>

        <?= $form->field($page, 'title') ?>
        <?= $form->field($page, 'alias') ?>
        <?= $form->field($page, 'caption') ?>

        <?php try {
            echo $this->render('/backend/elements/' . $page->id, compact('form', 'page'));
        } catch (ViewNotFoundException $e) {
            echo $form->field($page, 'content')->widget(CKEditor::class);
        } ?>
    </div>
    <div class="box-footer">
        <button class="btn btn-success">Сохранить</button>
    </div>

<?php ActiveForm::end() ?>
<?php $this->endContent() ?>