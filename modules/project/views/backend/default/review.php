<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\modules\project\models\Project $project
 */

$this->title = 'Отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Портфолио', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['backend/default/update', 'id' => $project->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/project/views/backend/layout.php', compact('project')) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="box-body">
        <?= $form->field($project, 'review_name') ?>
        <?= $form->field($project, 'review_post') ?>
        <?= $form->field($project, 'review_text')->textarea(['rows' => 5]) ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="single-kartik-image">
                    <?= $form->field($project, 'review_image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $project->getUploadedFileUrl('review_image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'deleteUrl' => Url::to(['delete-image-review', 'id' => $project->id]),
                            'initialPreview' => [
                                $project->getUploadedFileUrl('review_image'),
                            ],
                            'initialPreviewConfig' => [!$project->hasImageReview() ? [] :
                                [
                                    'caption' => $project->image,
                                    'size' => filesize($project->getUploadedFilePath('review_image')),
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
    </div>
    <div class="box-footer with-border">
        <button class="btn btn-success">Сохранить</button>
    </div>

<?php ActiveForm::end() ?>
<?php $this->endContent() ?>
