<?php

use app\modules\setting\types\map\assets\MapSettingAsset;
use yii\web\View;

/**
 * @var View $this
 * @var \yii\widgets\ActiveForm $form
 * @var \app\modules\setting\types\map\MapSetting $mapSetting
 */

MapSettingAsset::register($this);

?>

<?= $form->field($mapSetting, 'value')->hiddenInput()->label($mapSetting->title) ?>

<div id="map" style="width:100%" class="kv-grid-loading">
    <div class="kv-loader-overlay">
        <div class="kv-loader"></div>
    </div>
</div>
<span class="text-muted"><?= nl2br($mapSetting->hint) ?></span>
<?php $this->registerJs('mapsetting()'); ?>
