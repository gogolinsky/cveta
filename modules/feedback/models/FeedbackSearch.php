<?php

namespace app\modules\feedback\models;

use app\modules\feedback\factories\FormFactory;
use Yii;
use yii\data\ActiveDataProvider;

class FeedbackSearch extends Feedback
{
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    public function search($params)
    {
        $form = FormFactory::create(Yii::$app->request->get('type'));
        $query = $form::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['status' => $this->status]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}