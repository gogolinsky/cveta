<?php

use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\modules\category\models\Category $category
 * @var yii\widgets\ActiveForm $form
 * @var array $dropDownArray
 * @var array $dropDownOptionsArray
 */

$this->title = 'Добавление категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-9">
                    <?= $form->field($category, 'parent_id')->dropDownList($dropDownArray, $dropDownOptionsArray) ?>
                    <?= $form->field($category, 'title')->textInput(['class' => 'form-control transIt']) ?>
                    <?= $form->field($category, 'alias', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control transTo']) ?>
                    <?= $form->field($category, 'hint') ?>
                    <?= $form->field($category, 'has_paints')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
                </div>
                <div class="col-xs-3">
                    <div class="single-kartik-image">
                        <?= $form->field($category, 'image')->widget(FileInput::class, [
                            'pluginOptions' => [
                                'fileActionSettings' => [
                                    'showDrag' => false,
                                    'showZoom' => true,
                                    'showUpload' => false,
                                    'showDownload' => true,
                                ],
                                'initialPreviewDownloadUrl' => $category->getUploadedFileUrl('image'),
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'showClose' => false,
                                'showCancel' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                'browseLabel' =>  'Выберите файл',
                                'deleteUrl' => Url::to(['/category/backend/delete-image', 'id' => $category->id]),
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>

            <?= $form->field($category, 'content')->widget(CKEditor::class) ?>
        </div>
        <div class="box-footer">
            <button class="btn btn-success">Сохранить</button>
        </div>
    <?php ActiveForm::end() ?>
</div>