<?php

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public function init()
    {
        if (isset(Yii::$app->get('assetManager')->bundles[\yii\web\JqueryAsset::class])) {
            Yii::$app->get('assetManager')->bundles[\yii\web\JqueryAsset::class] = ['js' => []];
        }

        if (isset(Yii::$app->get('assetManager')->bundles[\yii\web\YiiAsset::class])) {
            Yii::$app->get('assetManager')->bundles[\yii\web\YiiAsset::class]->depends = [\app\assets\AppAsset::class];
        }

        parent::init();
    }

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/app.js'
    ];
}
