<?php

namespace app\modules\vendor\widgets;

use app\modules\vendor\models\Vendor;
use yii\base\Widget;

/**
 * @property Vendor $vendor
 */
class VendorWidget extends Widget
{
    public $vendor;

    public function run()
    {
        return $this->render('vendor', [
            'vendor' => $this->vendor,
        ]);
    }
}