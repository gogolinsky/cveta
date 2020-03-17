<?php

use app\helpers\FileHelper;
use app\modules\post\models\PostImage;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\post\models\Post $post
 * @var array $products
 * @var array $employees
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($post, 'title')->textInput(['class' => 'form-control transIt']) ?>
        <?= $form->field($post, 'alias')->textInput($post->isNewRecord ? [
            'class' => 'form-control transTo',
        ] : []) ?>
        <?= $form->field($post, 'content')->widget(CKEditor::class) ?>
        <?= $form->field($post, 'productsIds')->widget(Select2::class, [
            'data' => $products,
            'options' => ['placeholder' => '...', 'autocomplete' => 'off'],
            'showToggleAll' => false,
            'theme' => Select2::THEME_BOOTSTRAP,
            'pluginOptions' => ['multiple' => true, 'allowClear' => false],
        ]) ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($post, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $post->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $post->id]),
                            'initialPreview' => [
                                $post->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$post->hasImage() ? [] :
                                [
                                    'caption' => $post->image,
                                    'size' => filesize($post->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($post->getUploadedFilePath('image')),
                                ]
                            ],
                            'initialPreviewAsData' => true,
                        ],
                        'options' => ['accept' => 'image/png, image/jpeg, image/jpeg'],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php if (!$post->isNewRecord): ?>
                    <?= $form->field($post, 'images[]')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'uploadUrl' => Url::to(['/post/backend/image/upload', 'id' => $post->id]),
                            'deleteUrl' => Url::to(['/post/backend/image/delete']),
                            'initialPreview' => array_map(function(PostImage $image){
                                return $image->getUploadedFileUrl('image');
                            }, $post->images),
                            'initialPreviewConfig' => array_map(function(PostImage $image){
                                return [
                                    'key' => $image->id,
                                    'caption' => $image->image,
                                    'size' => filesize($image->getUploadedFilePath('image')),
                                    'downloadUrl' => $image->getUploadedFileUrl('image'),
                                ];
                            }, $post->images),
                            'initialPreviewAsData' => true,
                            'overwriteInitial' => false,
                            'showClose' => false,
                            'browseClass' => 'btn btn-primary text-right',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' =>  'Выберите файл',
                        ],
                        'pluginEvents' => [
                            'filesorted' => 'function(event, params) { 
                        $.post("' . Url::to(['/post/backend/image/sort']) . '",
                            { key : params.stack[params.newIndex].key, position : params.newIndex + 1 },
                        )
                    }',
                        ],
                        'options' => [
                            'multiple' => true,
                        ],
                    ]) ?>

                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <button class="btn btn-success">Сохранить</button>
        <a class="btn btn-default" href="<?= Url::to(['index']) ?>">Отмена</a>
    </div>
<?php ActiveForm::end() ?>
