<?php

namespace app\modules\product\helpers;

use app\modules\category\models\Category;
use app\modules\eav\models\EavAttributeOption;
use app\modules\eav\models\EavAttributeValue;
use app\modules\product\models\Product;
use app\modules\vendor\models\Vendor;
use yii\helpers\ArrayHelper;

class ProductHelper
{
    public static function generateDropDownArrays()
    {
        /** @var Category[] $categories */
        $categories = Category::find()->andWhere(['>', 'depth', 0])->orderBy(['lft' => SORT_ASC])->all();
        $dropDownArray = [];
        $dropDownOptionsArray = ['encodeSpaces' => false, 'prompt' => ''];

        foreach ($categories as $item) {
            $title = str_repeat('.', max((int) $item->depth - 1, 0));
            $title .= ' ' . $item->getTitle();
            $dropDownArray[$item->id] = $title;

            if (!$item->isLeaf()) {
                $dropDownOptionsArray['options'][$item->id]['disabled'] = true;
            }
        }

        return [$dropDownArray, $dropDownOptionsArray];
    }

    public static function getFilterDropDown()
    {
        $list = [];
        /** @var Category[] $categories */
        $categories = Category::find()->where(['>', 'depth', 0])->orderBy(['lft' => SORT_ASC])->all();

        foreach ($categories as $category) {
            $title = str_repeat('.', max((int) $category->depth - 1, 0));
            $title .= ' ' . $category->getTitle();
            $list[$category->id] = $title;
        }

        return $list;
    }

    public static function getOptionsList($attributeId, Category $category)
    {
        $categoryIds = array_merge([$category->id], $category->children()->select(['id'])->column());
        $optionIds = EavAttributeValue::find()
            ->joinWith(['entity'])
            ->where(['products.category_id' => $categoryIds, 'attribute_id' => $attributeId])
            ->select(['option_id'])
            ->column();

        /** @var EavAttributeOption[] $options */
        $options = EavAttributeOption::find()
            ->where(['id' => $optionIds])
            ->indexBy('id')
            ->orderBy(['value' => SORT_ASC])
            ->all();

        $list = ArrayHelper::map($options, 'id', function(EavAttributeOption $option) {
            return trim(implode(' ', [$option->value, $option->eavAttribute->unit]));
        });

        natcasesort($list);

        return $list;
    }

    public static function getVendorList()
    {
        return Vendor::find()->orderBy('title')->indexBy('id')->select('title')->column();
    }

    public static function getProductViewList()
    {
        return [
            Product::VIEW_DEFAULT => 'Обычное',
            Product::VIEW_CALCULATOR => 'С калькуляторм',
            Product::VIEW_COLOR => 'С выбором цвета',
        ];
    }
}
