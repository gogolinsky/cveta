<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\direction\models\Direction $direction
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($direction, 'title')->textInput(['class' => 'form-control transIt']) ?>
        <?= $form->field($direction, 'alias')->textInput($direction->isNewRecord ? [
            'class' => 'form-control transTo',
        ] : []) ?>
        <?= $form->field($direction, 'content')->widget(CKEditor::class) ?>
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                        <?= $form->field($direction, 'image')->widget(FileInput::class, [
                            'pluginOptions' => [
                                'fileActionSettings' => [
                                    'showDrag' => false,
                                    'showZoom' => true,
                                    'showUpload' => false,
                                    'showDelete' => false,
                                    'showDownload' => true,
                                ],
                                'initialPreviewDownloadUrl' => $direction->getUploadedFileUrl('image'),
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'showClose' => false,
                                'showCancel' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                'browseLabel' => 'Выберите файл',
                                'deleteUrl' => Url::to(['delete-image', 'id' => $direction->id]),
                                'initialPreview' => [
                                    $direction->getUploadedFileUrl('image'),
                                ],
                                'initialPreviewConfig' => [!$direction->hasImage() ? [] :
                                    [
                                        'caption' => $direction->image,
                                        'size' => filesize($direction->getUploadedFilePath('image')),
                                        'filetype'=> FileHelper::getMimeTypeByExtension($direction->getUploadedFilePath('image')),
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
                    <?= $form->field($direction, 'background')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $direction->getUploadedFileUrl('background'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-background', 'id' => $direction->id]),
                            'initialPreview' => [
                                $direction->getUploadedFileUrl('background'),
                            ],
                            'initialPreviewConfig' => [!$direction->hasImage() ? [] :
                                [
                                    'caption' => $direction->background,
                                    'size' => filesize($direction->getUploadedFilePath('background')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($direction->getUploadedFilePath('background')),
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
