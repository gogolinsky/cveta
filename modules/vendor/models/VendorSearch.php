<?php

namespace app\modules\vendor\models;

use yii\data\ActiveDataProvider;

class VendorSearch extends Vendor
{
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
        ];
    }

    public function search($params)
    {
        $query = Vendor::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
