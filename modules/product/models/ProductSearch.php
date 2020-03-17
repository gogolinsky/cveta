<?php

namespace app\modules\product\models;

use app\modules\category\models\Category;
use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public $parent;

    public function rules()
    {
        return [
            [['id', 'parent', 'vendor_id'], 'integer'],
            [['title', 'code'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = Product::find()->with('images');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 50],
            'sort' => ['defaultOrder' => ['created_at' => SORT_ASC]],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->parent) {
            /** @var Category $parentCategory */
            $parentCategory = Category::findOne($this->parent);
            $ids = $parentCategory->children()->select(['id'])->column();
            $ids[] = $parentCategory->id;
            $query->andFilterWhere(['category_id' => $ids]);
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['vendor_id' => $this->vendor_id]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
