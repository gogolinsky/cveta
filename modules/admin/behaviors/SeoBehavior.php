<?php

namespace app\modules\admin\behaviors;

use Yii;
use yii\base\Behavior;

class SeoBehavior extends Behavior
{
    public function getMetaTag($tag)
    {
        switch ($tag) {
            case 'meta_t':
                return $this->owner->meta_t
                    ? $this->owner->meta_t
                    : $this->owner->title;
            case 'meta_d':
                return $this->owner->meta_d
                    ? $this->owner->meta_d
                    : $this->owner->title;
            case 'meta_k':
                return $this->owner->meta_k
                    ? $this->owner->meta_k
                    : $this->owner->title;
            default:
                return $this->owner->title;
        }
    }

    public function generateMetaTags()
    {
        Yii::$app->controller->view->title = $this->getMetaTag('meta_t');
        Yii::$app->controller->view->registerMetaTag(['name' => 'description', 'content' => $this->getMetaTag('meta_d')]);
        Yii::$app->controller->view->registerMetaTag(['name' => 'keywords', 'content' => $this->getMetaTag('meta_k')]);
    }

    /**
     * @return string
     */
    public function getH1()
    {
        return $this->owner->h1 ? $this->owner->h1 : $this->owner->getTitle();
    }
}