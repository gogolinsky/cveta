<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\direction\models\Direction $direction
 */

?>

<div class="direction">
    <img class="direction__img" src="<?= $direction->getThumbFileUrl('image') ?>" alt="<?= $direction->getTitle() ?>">
    <div class="direction__badge">
        <p class="direction__title"><?= $direction->getTitle() ?></p>
        <div class="direction__link">
            <a class="button js-button is-callback" area-label="Подробнее" href="<?= $direction->getHref() ?>">Подробнее</a>
        </div>
    </div>
</div>
