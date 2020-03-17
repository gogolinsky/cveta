<?php

namespace app\widgets;

use app\modules\setting\components\Settings;
use yii\base\Widget;

class MapWidget extends Widget
{
    public function run()
    {
        $map = Settings::getArray('map');
        $dataMap = [
            'center' => $map['coords'],
            'zoom' => $map['zoom'],
            'markers' => [
                [
                    'address' => Settings::getRealValue('address'),
                    'coords' => $map['coords'],
                    'image' => [
                        'href' => '/img/marker.png',
                        'size' => [108, 88],
                        'offset' => [-54, -84],
                    ]
                ]
            ]
        ];

        return $this->render('map', compact('map', 'dataMap'));
    }
}