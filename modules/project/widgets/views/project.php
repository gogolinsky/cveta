<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\project\models\Project $project
 */

?>

<div class="service is-roll">
    <img class="service__img" src="<?= $project->getThumbFileUrl('image') ?>" alt="<?= $project->getTitle() ?>">
    <div class="service__badge">
        <p class="service__title"><?= $project->getTitle() ?></p>
        <div class="service__link">
            <a class="button js-button is-callback" area-label="Подробнее" href="<?= $project->getHref() ?>">Подробнее</a>
        </div>
    </div>
</div>