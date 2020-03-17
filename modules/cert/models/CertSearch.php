<?php

namespace app\modules\cert\models;

use yii\data\ActiveDataProvider;

class CertSearch extends Cert
{
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['title', 'string', 'max' => 255],
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

        return $dataProvider;
    }
}
