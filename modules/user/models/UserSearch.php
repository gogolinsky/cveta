<?php

namespace app\modules\user\models;

use yii\data\ActiveDataProvider;

/**
 * @property $date_from
 * @property $date_to
 * @property int $is_active
 * @property int $is_confirm
 */
class UserSearch extends User
{
    public $date_from;
    public $date_to;
    public $is_active;
    public $is_confirm;

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['is_active', 'is_confirm'], 'boolean'],
            ['email', 'string', 'max' => 255],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        $dataProvider->sort->attributes['is_active'] = [
            'asc' => ['blocked_at' => SORT_ASC],
            'desc' => ['blocked_at' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['is_confirm'] = [
            'asc' => ['confirmed_at' => SORT_ASC],
            'desc' => ['confirmed_at' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (null !== $this->is_active) {
            switch ($this->is_active) {
                case '0':
                    $dataProvider->query->andWhere(['not', ['blocked_at' => null]]);
                    break;
                case '1':
                    $dataProvider->query->andWhere(['blocked_at' => null]);
                    break;
            }
        }
        if (null !== $this->is_confirm) {
            switch ($this->is_confirm) {
                case '0':
                    $dataProvider->query->andWhere(['confirmed_at' => null]);
                    break;
                case '1':
                    $dataProvider->query->andWhere(['not', ['confirmed_at' => null]]);
                    break;
            }
        }

        $dataProvider->query->andFilterWhere(['id' => $this->id]);
        $dataProvider->query->andFilterWhere(['like', 'email', $this->email]);
        $dataProvider->query->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null]);
        $dataProvider->query->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }
}
