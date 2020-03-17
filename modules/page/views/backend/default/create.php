<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\page\models\Page $page
 * @var array $dropDownArray
 * @var array $dropDownOptionsArray
 */

$this->title = 'Добавить страницу';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить страницу';

?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-4">
                    <?= $form->field($page, 'parent_id')->dropDownList($dropDownArray, $dropDownOptionsArray) ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($page, 'id') ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($page, 'route'); ?>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($page, 'title')->textInput(['class' => 'form-control transIt']) ?>
                    <?= $form->field($page, 'alias')->textInput(['class' => 'form-control transTo']) ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-success">Сохранить</button>
        </div>

    <?php ActiveForm::end() ?>
</div>
