<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\service\models\Service $service
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($service, 'title')->textInput(['class' => 'form-control transIt']) ?>
        <?= $form->field($service, 'alias')->textInput($service->isNewRecord ? [
            'class' => 'form-control transTo',
        ] : []) ?>
        <?= $form->field($service, 'price') ?>
        <?= $form->field($service, 'slogan') ?>
        <?= $form->field($service, 'features')->textarea(['rows' => 10])->hint('Каждая особенность с новой строки', ['class' => 'text-muted']) ?>
        <?= $form->field($service, 'price_list')->textarea(['rows' => 10])->hint('Название услуги #1 : стоимость<br>Название услуги #2 : стоимость', ['class' => 'text-muted']) ?>
        <?= $form->field($service, 'content')->widget(CKEditor::class) ?>
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                        <?= $form->field($service, 'image')->widget(FileInput::class, [
                            'pluginOptions' => [
                                'fileActionSettings' => [
                                    'showDrag' => false,
                                    'showZoom' => true,
                                    'showUpload' => false,
                                    'showDelete' => false,
                                    'showDownload' => true,
                                ],
                                'initialPreviewDownloadUrl' => $service->getUploadedFileUrl('image'),
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'showClose' => false,
                                'showCancel' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                'browseLabel' => 'Выберите файл',
                                'deleteUrl' => Url::to(['delete-image', 'id' => $service->id]),
                                'initialPreview' => [
                                    $service->getUploadedFileUrl('image'),
                                ],
                                'initialPreviewConfig' => [!$service->hasImage() ? [] :
                                    [
                                        'caption' => $service->image,
                                        'size' => filesize($service->getUploadedFilePath('image')),
                                        'filetype'=> FileHelper::getMimeTypeByExtension($service->getUploadedFilePath('image')),
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
                    <?= $form->field($service, 'background')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $service->getUploadedFileUrl('background'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-background', 'id' => $service->id]),
                            'initialPreview' => [
                                $service->getUploadedFileUrl('background'),
                            ],
                            'initialPreviewConfig' => [!$service->hasImage() ? [] :
                                [
                                    'caption' => $service->background,
                                    'size' => filesize($service->getUploadedFilePath('background')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($service->getUploadedFilePath('background')),
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
