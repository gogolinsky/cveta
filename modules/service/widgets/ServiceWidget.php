<?php

namespace app\modules\service\widgets;

use yii\base\Widget;

/**
 * @property \app\modules\service\models\Service $service
 */
class ServiceWidget extends Widget
{
    public $service;

    public function run()
    {
        return $this->render('service', [
            'service' => $this->service,
        ]);
    }
}