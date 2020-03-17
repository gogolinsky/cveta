<?php

use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\vendor\models\Vendor $vendor
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <div class="box-body">
        <?= $form->field($vendor, 'title')->textInput(['class' => 'form-control transIt']) ?>
        <?= $form->field($vendor, 'alias')->textInput( $vendor->isNewRecord ? ['class' => 'form-control transTo'] : []) ?>
        <?= $form->field($vendor, 'hint') ?>
        <?= $form->field($vendor, 'content')->widget(CKEditor::class) ?>

        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($vendor, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $vendor->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $vendor->id]),
                            'initialPreview' => [
                                $vendor->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$vendor->hasImage() ? [] :
                                [
                                    'caption' => $vendor->image,
                                    'size' => filesize($vendor->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($vendor->getUploadedFilePath('image')),
                                ]
                            ],
                            'initialPreviewAsData' => true,
                        ],
                        'options' => ['accept' => 'image/png, image/jpeg, image/jpeg'],
                    ]) ?>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($vendor, 'background')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $vendor->getUploadedFileUrl('background'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-background', 'id' => $vendor->id]),
                            'initialPreview' => [
                                $vendor->getUploadedFileUrl('background'),
                            ],
                            'initialPreviewConfig' => [!$vendor->hasImage() ? [] :
                                [
                                    'caption' => $vendor->background,
                                    'size' => filesize($vendor->getUploadedFilePath('background')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($vendor->getUploadedFilePath('background')),
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
    <div class="box-footer">
        <button class="btn btn-success">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
    </div>

<?php ActiveForm::end() ?>
