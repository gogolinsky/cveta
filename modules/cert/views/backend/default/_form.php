<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\cert\models\Cert $cert
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($cert, 'title') ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($cert, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $cert->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $cert->id]),
                            'initialPreview' => [
                                $cert->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$cert->hasImage() ? [] :
                                [
                                    'caption' => $cert->image,
                                    'size' => filesize($cert->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($cert->getUploadedFilePath('image')),
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
