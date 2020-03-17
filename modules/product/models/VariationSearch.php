<?php

namespace app\modules\product\models;

use yii\data\ActiveDataProvider;

class VariationSearch extends Variation
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = Variation::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
            'pagination' => ['defaultPageSize' => 50],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}