<?php

namespace app\modules\service\widgets;

use app\modules\service\models\Service;
use yii\base\Widget;

class ServicesWidget extends Widget
{
    public function run()
    {
        $services = Service::find()->orderBy(['position' => SORT_ASC])->all();

        return $this->render('services', compact('services'));
    }
}