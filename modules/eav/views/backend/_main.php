<?php

use app\modules\eav\models\EavAttributeType;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\modules\eav\models\EavAttribute $model
 */

$this->title = 'Обновить ' . ' ' . $model->getLabel();
$this->params['breadcrumbs'][] = ['label' => 'Аттрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->getLabel();

?>

<?php $this->beginContent('@app/modules/eav/views/backend/update.php', compact('model')) ?>
    <?php $form = ActiveForm::begin() ?>

        <div class="panel">
            <div class="panel-body">
                <?= $form->field($model, 'title') ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'label') ?>
                <?= $form->field($model, 'unit') ?>
                <?= $form->field($model, 'type_id')->dropDownList(EavAttributeType::getList()) ?>
                <div class="single-kartik-image">
                    <?= $form->field($model, 'icon')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $model->getUploadedFileUrl('icon'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' =>  'Выберите файл',
                            'deleteUrl' => Url::to(['/eav/backend/delete-icon', 'id' => $model->id]),
                            'initialPreview' => [
                                $model->hasIcon() ? $model->getUploadedFileUrl('icon') : null,
                            ],
                            'initialPreviewConfig' => [
                                $model->hasIcon() ? [
                                    'caption' => $model->icon,
                                    'size' => filesize($model->getUploadedFilePath('icon')),
                                    'downloadUrl' => $model->getUploadedFileUrl('icon'),
                                ] : [],
                            ],
                            'initialPreviewAsData' => true,
                        ],
                        'options' => ['accept' => 'image/svg+xml'],
                    ]);?>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">Сохранить</button>
                </div>
            </div>
        </div>

    <?php ActiveForm::end() ?>
<?php $this->endContent() ?>