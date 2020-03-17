<?php

namespace app\modules\setting\types;

use app\modules\setting\models\Setting;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;

class HtmlSetting extends Setting
{
    const TYPE = 'html';
    const NAME = 'HTML';

    public function formField(ActiveForm $form)
    {
        return $form->field($this, 'value')->widget(CKEditor::class)->hint(nl2br($this->hint), ['options' => ['class' => 'text-muted']])->label($this->title);
    }
}