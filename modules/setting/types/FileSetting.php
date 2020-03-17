<?php

namespace app\modules\setting\types;

use app\modules\setting\helpers\FileSettingHelper;
use app\modules\setting\models\Setting;
use kartik\file\FileInput;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\bootstrap\ActiveForm;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * Class FileSetting
 * @package app\modules\setting\types
 *
 * @mixin FileUploadBehavior
 */
class FileSetting extends Setting
{
    const TYPE = 'file';
    const NAME = 'Файл';

    public function rules()
    {
        return [
            [['id', 'type', 'title'], 'required'],
            ['value', 'file'],
            [['id', 'type', 'title', 'description', 'hint'], 'string'],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['file'] = [
            'class' => FileUploadBehavior::class,
            'attribute' => 'value',
            'filePath' => '@webroot/uploads/setting/[[pk]]_[[attribute_hash]].[[extension]]',
            'fileUrl' => '/uploads/setting/[[pk]]_[[attribute_hash]].[[extension]]',
        ];
        return $behaviors;
    }

    public function formField(ActiveForm $form)
    {
        return $form->field($this, 'value')->widget(FileInput::class, [
            'pluginOptions' => [
                'fileActionSettings' => [
                    'showDelete' => true,
                    'showDrag' => false,
                    'showUpload' => false,
                ],
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'showClose' => false,
                'showCancel' => false,
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                'browseLabel' =>  'Выберите файл',
                'pluginOptions' => ['previewFileType' => 'any'],
                'deleteUrl' => Url::to(['/setting/backend/file/delete-file', 'id' => $this->id]),
                'initialPreviewConfig' => [
                    is_file($this->getUploadedFilePath('value')) ? [
                        'type'=> FileSettingHelper::getType($this->value),
                        'caption' => $this->value,
                        'size' => filesize($this->getUploadedFilePath('value')),
                        'downloadUrl' => $this->getUploadedFileUrl('value'),
                        'filetype'=> FileHelper::getMimeTypeByExtension($this->value),
                    ] : [],
                ],
                'initialPreview'=>[
                    $this->getUploadedFileUrl('value'),
                ],
                'initialPreviewAsData'=>true,
            ],
        ])->hint(nl2br($this->hint), ['options' => ['class' => 'text-muted']])->label($this->title);
    }

    public function getValue()
    {
        if (!$this->hasFile()) {
            return '';
        }

        return $this->getUploadedFileUrl('value');
    }

    public function hasFile()
    {
        return !empty($this->value);
    }

    public function deleteFile()
    {
        $path = $this->getUploadedFilePath('value');
        FileHelper::removeDirectory(pathinfo($path, PATHINFO_DIRNAME));
        $this->updateAttributes([
            'value' => null,
            'hash' => null,
        ]);
    }


    public function beforeSave($insert)
    {
        if ($this->value instanceof UploadedFile) {
            $this->hash = uniqid();
        }
        return parent::beforeSave($insert);
    }
}