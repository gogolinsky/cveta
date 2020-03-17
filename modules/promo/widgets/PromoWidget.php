<?php

namespace app\modules\promo\widgets;

use yii\base\Widget;

/**
 * @property \app\modules\promo\models\Promo $promo
 */
class PromoWidget extends Widget
{
    public $promo;

    public function run()
    {
        return $this->render('promo', [
            'promo' => $this->promo,
        ]);
    }
}