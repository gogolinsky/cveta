<?php

namespace app\modules\page\models;

use yii\data\ActiveDataProvider;

class PageSearch extends Page
{
    /** @var $parent */
    public $parent;

    public function rules()
    {
        return [
            [['id', 'title', 'alias', 'parent'], 'string', 'max' => 255],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Page::find()->andWhere(['>', 'depth', 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['lft' => SORT_ASC]],
            'pagination' => ['defaultPageSize' => 20],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->parent) {
            /** @var Page $parentPage */
            $parentPage = Page::findOne($this->parent);
            $ids = $parentPage->children()->select(['id'])->column();
            $query->andFilterWhere(['id' => $ids]);
        }

        $query->andFilterWhere(['like', 'id', $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
