<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\service\models\Service $service
 */

?>

<div class="service">
    <div class="service__shadow"></div>
    <img class="service__img" src="<?= $service->getThumbFileUrl('image') ?>" alt="<?= $service->getTitle() ?>">
    <div class="service__badge" >
        <p class="service__title"><?= $service->getTitle() ?></p>
        <p class="service__price"><?= $service->price ?></p>
        <div class="service__link">
            <a class="button js-button is-callback" area-label="Подробнее" href="<?= $service->getHref() ?>">Подробнее</a>
        </div>
        <!-- <svg width="0" height="0">
            <filter id="svgBlurFilter">
                <feGaussianBlur in="SourceGraphic" stdDeviation="5" />
            </filter>
        </svg> -->
    </div>
</div>
