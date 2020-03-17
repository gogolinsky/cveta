<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\promo\models\Promo $promo
 */

?>


<div class="service is-stock">
    <img class="service__img" src="<?= $promo->getThumbFileUrl('image') ?>" alt="<?= $promo->getTitle() ?>">
    <div class="service__badge">
        <p class="service__title"><?= $promo->getTitle() ?></p>

        <div class="service__link">
            <a class="button js-button is-callback" area-label="Подробнее" href="<?= $promo->getHref() ?>">Подробнее</a>
        </div>
    </div>
</div>
