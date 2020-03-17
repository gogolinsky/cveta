<?php

use app\helpers\DateHelper;

/**
 * @var $this \yii\web\View
 * @var \app\modules\post\models\Post $post
 */

?>

<div class="post">
    <img class="post__img" src="<?= $post->getThumbFileUrl('image') ?>" alt="<?= $post->getTitle() ?>">
    <a class="post__preview">
        <time class="post__time"><?= DateHelper::forHuman($post->created_at) ?></time>
        <h3 class="post__title"><?= $post->getTitle() ?></h3>
        <div class="post__button">
            <a class="button js-button is-callback" area-label="Подробнее" href="<?= $post->getHref() ?>">Подробнее</a>
        </div>
    </a>
</div>