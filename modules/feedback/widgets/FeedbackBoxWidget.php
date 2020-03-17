<?php

namespace app\modules\feedback\widgets;

use app\modules\feedback\models\Feedback;
use yii\base\Widget;

class FeedbackBoxWidget extends Widget
{
    public function run()
    {
        $feedbacks = Feedback::find()->orderBy(['created_at' => SORT_DESC])->where(['NOT', ['status' => 4]])->limit(4)->all();

        return $this->render('feedback_box', compact('feedbacks'));
    }
}