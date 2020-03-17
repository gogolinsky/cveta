<?php

namespace app\modules\post\widgets;

use yii\base\Widget;

/**
 * @property \app\modules\post\models\Post $post
 */
class PostWidget extends Widget
{
    public $post;

    public function run()
    {
        return $this->render('post', [
            'post' => $this->post,
        ]);
    }
}