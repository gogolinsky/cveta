<?php

namespace app\modules\admin\assets;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/resources';
    public $css = [
        'css/typicons.min.css',
        'css/style-lte.css',
    ];
    public $js = [
        'js/jquery.liTranslit.js',
        'js/script.js',
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\cdn\AssetBundle',
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];

    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV,
    ];
}
