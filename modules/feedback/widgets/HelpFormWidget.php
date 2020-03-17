<?php

namespace app\modules\feedback\widgets;

use app\modules\feedback\forms\HelpForm;
use yii\base\Widget;

/**
 * @property HelpForm $feedback
 */
class HelpFormWidget extends Widget
{
    public $feedback;

    public function init()
    {
        if (empty($this->form)) {
            $this->feedback = new HelpForm();
        }
    }

    public function run()
    {
        return $this->render('help_form', [
            'feedback' => $this->feedback,
        ]);
    }
}