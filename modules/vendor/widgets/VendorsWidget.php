<?php

namespace app\modules\vendor\widgets;

use app\modules\vendor\models\Vendor;
use yii\base\Widget;

/**
 * @property boolean $showButtonToVendors
 */
class VendorsWidget extends Widget
{
    public $showButtonToVendors = true;
    public $showText = true;
    public $sectionClass = '';
    public $limit = null;

    public function run()
    {
        $query = Vendor::find()->orderBy('position');

        if (!$this->limit) {
        	$query->limit($this->limit);
        }

        $vendors = $query->all();

        return $this->render('vendors', [
            'vendors' => $vendors,
            'showButtonToVendors' => $this->showButtonToVendors,
            'showText' => $this->showText,
            'sectionClass' => $this->sectionClass,
        ]);
    }
}