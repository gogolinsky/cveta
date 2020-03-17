<?php

namespace app\modules\setting\types\map\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class MapSettingAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/setting/types/map/resources';
    public $js = [
        'https://api-maps.yandex.ru/2.1/?lang=ru_RU&onload=mapsetting&mode=debug',
        'js/script.js',
    ];
    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV,
    ];
}