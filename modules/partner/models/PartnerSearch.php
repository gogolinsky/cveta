<?php

namespace app\modules\partner\models;

use yii\data\ActiveDataProvider;

class PartnerSearch extends Partner
{
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['title', 'link'], 'string', 'max' => 255],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
            'query' => self::find(),
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);

        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        $dataProvider->query->andFilterWhere(['id' => $this->id]);
        $dataProvider->query->andFilterWhere(['like', 'title', $this->title]);
        $dataProvider->query->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
