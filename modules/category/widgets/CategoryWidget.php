<?php

namespace app\modules\category\widgets;

use app\modules\category\models\Category;
use yii\base\Widget;

/**
 * @property Category $category
 */
class CategoryWidget extends Widget
{
    public $category;

    public function run()
    {
        return $this->render('category', ['category' => $this->category]);
    }
}