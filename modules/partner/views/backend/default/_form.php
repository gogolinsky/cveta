<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\partner\models\Partner $partner
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($partner, 'title') ?>
        <?= $form->field($partner, 'link') ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($partner, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $partner->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $partner->id]),
                            'initialPreview' => [
                                $partner->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$partner->hasImage() ? [] :
                                [
                                    'caption' => $partner->image,
                                    'size' => filesize($partner->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($partner->getUploadedFilePath('image')),
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
