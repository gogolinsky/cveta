<?php

use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/**
 * @var \app\modules\category\models\Category $category
 * @var array $dropDownArray
 * @var array $dropDownOptionsArray
 */

$this->title = $category->getTitle();
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/category/views/backend/update.php', compact('category')) ?>
<?php $form = ActiveForm::begin() ?>
    <div class="box-body">
        <div class="row">

            <div class="col-xs-9">
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($category, 'parent_id')->dropDownList($dropDownArray, $dropDownOptionsArray) ?>
                    </div>
                </div>

                <?= $form->field($category, 'title') ?>
                <?= $form->field($category, 'alias', ['enableAjaxValidation' => true]) ?>
                <?= $form->field($category, 'hint') ?>
                <?= $form->field($category, 'caption') ?>
                <?= $form->field($category, 'has_paints')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
            </div>
            <div class="col-xs-3">
                <div class="single-kartik-image">
                    <img src="<?= $category->image ?>" alt="">
                    <?= $form->field($category, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $category->getThumbFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' =>  'Выберите файл',
                            'deleteUrl' => Url::to(['/category/backend/delete-image', 'id' => $category->id]),
                            'initialPreview' => [
                                $category->hasImage() ? $category->getThumbFileUrl('image') : null,
                            ],
                            'initialPreviewConfig' => [
                                $category->hasImage() ? [
                                    'caption' => $category->image,
                                    'size' => filesize($category->getThumbFilePath('image')),
                                    'downloadUrl' => $category->getThumbFileUrl('image'),
                                ] : [],
                            ],
                            'initialPreviewAsData' => true,
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

<?php $form::end() ?>
<?php $this->endContent() ?>
