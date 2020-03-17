<?php

namespace app\modules\setting\models;

use yii\data\ActiveDataProvider;

class SettingSearch extends Setting
{
    public function rules()
    {
        return [
            [['id', 'title', 'type', 'value'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = Setting::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['type' => $this->type]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}