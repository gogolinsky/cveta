<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\employee\models\Employee $employee
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($employee, 'title') ?>
        <?= $form->field($employee, 'post') ?>
        <?= $form->field($employee, 'description')->textarea(['rows' => 3]) ?>
        <?= $form->field($employee, 'content')->widget(CKEditor::class) ?>

        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($employee, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $employee->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $employee->id]),
                            'initialPreview' => [
                                $employee->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$employee->hasImage() ? [] :
                                [
                                    'caption' => $employee->image,
                                    'size' => filesize($employee->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($employee->getUploadedFilePath('image')),
                                ]
                            ],
                            'initialPreviewAsData' => true,
                        ],
                        'options' => ['accept' => 'image/png, image/jpeg, image/jpeg'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <button class="btn btn-success">Сохранить</button>
        <a class="btn btn-default" href="<?= Url::to(['index']) ?>">Отмена</a>
    </div>
<?php ActiveForm::end() ?>
