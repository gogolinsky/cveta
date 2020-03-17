<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\slider\models\Slide $slider
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($slider, 'title') ?>
        <?= $form->field($slider, 'description') ?>
        <?= $form->field($slider, 'link') ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($slider, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $slider->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $slider->id]),
                            'initialPreview' => [
                                $slider->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$slider->hasImage() ? [] :
                                [
                                    'caption' => $slider->image,
                                    'size' => filesize($slider->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($slider->getUploadedFilePath('image')),
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
