<?php

namespace app\modules\eav\models;

use yii\data\ActiveDataProvider;

class EavAttributeSearch extends EavAttribute
{
    public function rules()
    {
        return [
            [['id', 'type_id', 'in_filter', 'is_important', 'is_packing'], 'integer'],
            [['title', 'name', 'label', 'unit'], 'string'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = EavAttribute::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 50],
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['in_filter' => $this->in_filter]);
        $query->andFilterWhere(['is_important' => $this->is_important]);
        $query->andFilterWhere(['is_packing' => $this->is_packing]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'label', $this->label]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'unit', $this->unit]);

        return $dataProvider;
    }
}
