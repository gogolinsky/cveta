<?php

namespace app\modules\category\models;

use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public $parent;

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
            ['parent', 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Category::find()->andWhere(['>', 'depth', 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['lft' => SORT_ASC]],
            'pagination' => ['defaultPageSize' => 50],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->parent) {
            /** @var Category $parentCategory */
            $parentCategory = Category::findOne($this->parent);
            $ids = $parentCategory->children()->select(['id'])->column();
            $query->andFilterWhere(['id' => $ids]);
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
