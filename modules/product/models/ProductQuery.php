<?php

namespace app\modules\product\models;

use app\modules\category\models\Category;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    /**
     * @param Category $category
     * @return static
     */
   public function inCategory(Category $category)
   {
       $catIds = $category->children()->select('id')->column();
       array_push($catIds, $category->id);
       return $this->andWhere(['category_id' => $catIds]);
   }
}