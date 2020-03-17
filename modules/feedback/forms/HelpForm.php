<?php

namespace app\modules\feedback\forms;

use app\modules\feedback\models\Feedback;

class HelpForm extends Feedback
{
    const TYPE = 'help';
    const TITLE = 'Помощь эксперта';

    public function rules()
    {
        return [
            ['status', 'integer'],
            [['phone'], 'required', 'message' => 'Заполните поле'],
            [['phone'], 'string', 'max' => 255],
        ];
    }

    public function gridAttrs()
    {
        return ['created_at', 'status', 'phone'];
    }
}