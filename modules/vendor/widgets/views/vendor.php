<?php

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\vendor\models\Vendor $vendor
 */

?>


<a class="vendor" href="<?= $vendor->getHref() ?>" title="<?= Html::encode($vendor->title) ?>">
    <div class="vendor__cover">
        <img class="vendor__logo" src="<?= $vendor->getThumbFileUrl('image', 'view') ?>" alt="<?= Html::encode($vendor->title) ?>"/>
    </div>
</a>