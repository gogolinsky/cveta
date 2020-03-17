<?php

namespace app\modules\page\widgets;

use app\modules\page\models\Page;
use yii\base\Widget;

class PagesBoxWidget extends Widget
{
    public function run()
    {
        $pages = Page::find()->orderBy(['updated_at' => SORT_DESC])->limit(4)->all();

        return $this->render('pages_box', compact('pages'));
    }
}