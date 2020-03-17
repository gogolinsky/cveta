<?php

namespace app\modules\feedback\forms;

use app\modules\feedback\models\Feedback;

class CallbackForm extends Feedback
{
    const TYPE = 'callback';
    const TITLE = 'Обратный звонок';
    const ICON = 'phone-square';

    public function rules()
    {
        return [
            ['status', 'integer'],
            [['phone'], 'required', 'message' => 'Заполните поле'],
            [['name', 'phone'], 'string', 'max' => 255],
            ['comment', 'string'],
        ];
    }

    public function gridAttrs()
    {
        return ['created_at', 'status', 'phone', 'name'];
    }
}