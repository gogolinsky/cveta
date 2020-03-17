<?php

use app\helpers\FileHelper;
use app\modules\project\models\ProjectImage;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\project\models\Project $project
 * @var array $products
 * @var array $employees
 */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-body">
        <?= $form->field($project, 'title')->textInput(['class' => 'form-control transIt']) ?>
        <?= $form->field($project, 'alias')->textInput($project->isNewRecord ? [
            'class' => 'form-control transTo',
        ] : []) ?>
        <?= $form->field($project, 'date') ?>
        <?= $form->field($project, 'task')->textarea(['rows' => 2]) ?>
        <?= $form->field($project, 'works')->textarea(['rows' => 10]) ?>
        <?= $form->field($project, 'description')->widget(CKEditor::class) ?>
        <?= $form->field($project, 'productsIds')->widget(Select2::class, [
            'data' => $products,
            'options' => ['placeholder' => '...', 'autocomplete' => 'off'],
            'showToggleAll' => false,
            'theme' => Select2::THEME_BOOTSTRAP,
            'pluginOptions' => ['multiple' => true, 'allowClear' => false],
        ]) ?>
        <?= $form->field($project, 'employeesIds')->widget(Select2::class, [
            'data' => $employees,
            'options' => ['placeholder' => '...', 'autocomplete' => 'off'],
            'showToggleAll' => false,
            'theme' => Select2::THEME_BOOTSTRAP,
            'pluginOptions' => ['multiple' => true, 'allowClear' => false],
        ]) ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($project, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $project->getUploadedFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image', 'id' => $project->id]),
                            'initialPreview' => [
                                $project->getUploadedFileUrl('image'),
                            ],
                            'initialPreviewConfig' => [!$project->hasImage() ? [] :
                                [
                                    'caption' => $project->image,
                                    'size' => filesize($project->getUploadedFilePath('image')),
                                    'filetype'=> FileHelper::getMimeTypeByExtension($project->getUploadedFilePath('image')),
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
                <?php if (!$project->isNewRecord): ?>
                    <?= $form->field($project, 'images[]')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'uploadUrl' => Url::to(['/project/backend/image/upload', 'id' => $project->id]),
                            'deleteUrl' => Url::to(['/project/backend/image/delete']),
                            'initialPreview' => array_map(function(ProjectImage $image){
                                return $image->getUploadedFileUrl('image');
                            }, $project->images),
                            'initialPreviewConfig' => array_map(function(ProjectImage $image){
                                return [
                                    'key' => $image->id,
                                    'caption' => $image->image,
                                    'size' => filesize($image->getUploadedFilePath('image')),
                                    'downloadUrl' => $image->getUploadedFileUrl('image'),
                                ];
                            }, $project->images),
                            'initialPreviewAsData' => true,
                            'overwriteInitial' => false,
                            'showClose' => false,
                            'browseClass' => 'btn btn-primary text-right',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' =>  'Выберите файл',
                        ],
                        'pluginEvents' => [
                            'filesorted' => 'function(event, params) { 
                        $.post("' . Url::to(['/project/backend/image/sort']) . '",
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
