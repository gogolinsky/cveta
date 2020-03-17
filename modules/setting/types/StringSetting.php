<?php

namespace app\modules\setting\types;

use app\modules\setting\models\Setting;
use yii\bootstrap\ActiveForm;

class StringSetting extends Setting
{
    const TYPE = 'string';
    const NAME = 'Строка';

    public function formField(ActiveForm $form)
    {
        return $form->field($this, 'value')->hint(nl2br($this->hint), ['options' => ['class' => 'text-muted']])->label($this->title);
    }
}