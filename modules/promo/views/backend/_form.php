<?php

use app\helpers\FileHelper;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\promo\models\Promo $promo
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($promo, 'title')->textInput(['class' => 'form-control transIt']) ?>
        <?= $form->field($promo, 'alias')->textInput($promo->isNewRecord ? [
            'class' => 'form-control transTo',
        ] : []) ?>
        <?= $form->field($promo, 'content')->widget(CKEditor::class) ?>
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                        <?= $form->field($promo, 'image')->widget(FileInput::class, [
                            'pluginOptions' => [
                                'fileActionSettings' => [
                                    'showDrag' => false,
                                    'showZoom' => true,
                                    'showUpload' => false,
                                    'showDelete' => false,
                                    'showDownload' => true,
                                ],
                                'initialPreviewDownloadUrl' => $promo->getUploadedFileUrl('image'),
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'showClose' => false,
                                'showCancel' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                'browseLabel' => 'Выберите файл',
                                'deleteUrl' => Url::to(['delete-image', 'id' => $promo->id]),
                                'initialPreview' => [
                                    $promo->getUploadedFileUrl('image'),
                                ],
                                'initialPreviewConfig' => [!$promo->hasImage() ? [] :
                                    [
                                        'caption' => $promo->image,
                                        'size' => filesize($promo->getUploadedFilePath('image')),
                                        'filetype'=> FileHelper::getMimeTypeByExtension($promo->getUploadedFilePath('image')),
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
