<?php

namespace app\modules\category\helpers;

use app\modules\category\models\Category;

class CategoryHelper
{
    /**
     * @param null|Category $model
     * @return array
     */
    public static function generateDropDownArrays($model = null)
    {
        /** @var Category[] $categories */
        $categories = Category::find()->orderBy(['lft' => SORT_ASC])->all();
        $dropDownArray = [];
        $dropDownOptionsArray = ['encodeSpaces' => false];

        foreach ($categories as $item) {
            $title = str_repeat('.', max((int) $item->depth - 1, 0));
            $title .= ' ' . $item->getTitle();
            $dropDownArray[$item->id] = $title;

            if (null !== $model && $item->id === $model->id) {
                $dropDownOptionsArray['options'][$item->id]['disabled'] = true;
            }
        }

        return [$dropDownArray, $dropDownOptionsArray];
    }

    /**
     * @return array
     */
    public static function getFilter()
    {
        $list = [];
        /** @var Category[] $models */
        $models = Category::find()->andWhere(['>', 'depth', 0])->orderBy(['lft' => SORT_ASC])->all();

        foreach ($models as $model) {
            $model = Category::findOne($model->id);
            if (!$model->isLeaf()) {
                $list[$model->id] = str_repeat('.', max((int) $model->depth - 1, 0)) . ' ' . $model->getTitle();
            }
        }

        return $list;
    }

    public static function getCategoryIds(Category $category)
    {
        $result = $category->children()->select('id')->column();
        $result[] = $category->id;

        return $result;
    }
}