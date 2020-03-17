<?php

namespace app\modules\filter\widgets;

use app\modules\filter\forms\FilterForm;
use app\modules\category\helpers\CategoryHelper;
use app\modules\vendor\models\Vendor;
use yii\base\Widget;

/**
 * @property FilterForm $filterForm
 */
class FilterWidget extends Widget
{
    public $filterForm;

    public function run()
    {
        $query = Vendor::find()->innerJoinWith(['products', 'products.directions']);

        if (!empty($this->filterForm->category)) {
            $query->where(['products.category_id' => CategoryHelper::getCategoryIds($this->filterForm->category)]);
        }

        if (!empty($this->filterForm->direction)) {
            $query->where(['directions.id' => $this->filterForm->direction->id]);
        }

        $vendors = $query->orderBy(['vendors.position' => SORT_ASC])->all();

        return $this->render('filter', [
            'vendors' => $vendors,
            'filterForm' => $this->filterForm
        ]);
    }
}