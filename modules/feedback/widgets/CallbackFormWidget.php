<?php

namespace app\modules\feedback\widgets;

use app\modules\feedback\forms\CallbackForm;
use yii\base\Widget;

/**
 * @property CallbackForm $feedback
 */
class CallbackFormWidget extends Widget
{
    public $feedback;

    public function init()
    {
        if (empty($this->feedback)) {
            $this->feedback = new CallbackForm();
        }
    }

    public function run()
    {
        return $this->render('callback_form', [
            'feedback' => $this->feedback,
        ]);
    }
}