<?php

namespace app\modules\filter\forms;

use app\modules\category\models\Category;
use app\modules\direction\models\Direction;
use app\modules\product\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @property Direction $direction
 * @property Category $category
 * @property array $vendor_ids
 * @property int $sort
 */
class FilterForm extends Model
{
    public $direction = null;
    public $category = null;
    public $vendor_ids = [];
    public $category_ids = [];

    private $catIds = null;

    public function rules() : array
    {
        return [
            ['vendor_ids', 'safe']
        ];
    }

    public function filter() : ActiveDataProvider
    {
        $query = Product::find();

        if (!empty($this->category)) {
            $query->andWhere(['category_id' => $this->getCategoryIds()]);
        }

        if (!empty($this->direction)) {
            $query->innerJoinWith(['directions'])->andWhere(['directions.id' => $this->direction->id]);
        }

        $query->andFilterWhere(['vendor_id' => $this->vendor_ids]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 50, 'forcePageParam' => false],
            'sort' => ['defaultOrder' => ['price' => SORT_ASC]]
        ]);
    }

    public function getCategoryIds()
    {
        if (is_null($this->catIds)) {
            $this->catIds = $this->category->children()->select('id')->column();
            $this->catIds[] = $this->category->id;
        }

        return $this->catIds;
    }
}
