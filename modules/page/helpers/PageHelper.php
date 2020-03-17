<?php

namespace app\modules\page\helpers;

use app\modules\page\models\Page;

class PageHelper
{
    public static function generateDropDownArrays(Page $inside = null)
    {
        /** @var Page[] $models */
        $models = Page::find()->orderBy(['lft' => SORT_ASC])->all();
        $dropDownArray = [];
        $dropDownOptionsArray = ['encodeSpaces' => false];

        foreach ($models as $model) {
            $dropDownArray[$model->id] = self::getNestedSetTitle($model->getTitle(), $model->depth);
            if (null !== $inside && $model->id === $inside->id) {
                $dropDownOptionsArray['options'][$model->id]['disabled'] = true;
            }
        }

        return [$dropDownArray, $dropDownOptionsArray];
    }

    public static function getNestedSetTitle($title, $depth)
    {
        return str_repeat('.', max((int) $depth - 1, 0)) . $title;
    }

    public static function getFilter()
    {
        $list = [];
        /** @var Page[] $pages */
        $pages = Page::find()->andWhere(['>', 'depth', 0])->orderBy(['lft' => SORT_ASC])->all();

        foreach ($pages as $page) {
            if (!$page->isLeaf()) {
                $place = str_repeat('.', max((int) $page->depth - 1, 0));
                $list[$page->id] = $place . $page->getTitle();
            }
        }

        return $list;
    }

    public function getOptionsCheckList(Page $page) {
        return array_map(function($option){
            return ;
        }, $page->options, array_keys($page->options));
    }
}