<?php

namespace app\modules\setting\types;

use app\modules\setting\models\Setting;
use yii\bootstrap\ActiveForm;

class TextSetting extends Setting
{
    const TYPE = 'text';
    const NAME = 'Текст';

    public function formField(ActiveForm $form)
    {
        return $form->field($this, 'value')->textarea(['rows' => 10])->hint(nl2br($this->hint), ['options' => ['class' => 'text-muted']])->label($this->title);
    }

    public function getValue()
    {
        return nl2br($this->value);
    }
}