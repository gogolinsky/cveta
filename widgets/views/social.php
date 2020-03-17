<?php

/**
 * @var \yii\web\View $this
 * @var string $instagram
 * @var string $facebook
 * @var string $vk
 * @var string $htmlClass
 */

?>

<ul class="social <?= $htmlClass ?>">
    <?php if (!empty($vk)): ?>
        <li class="social__item is-vk">
            <a class="social__link" title="vk" href="<?= $vk ?>" area-label="vk" target="_blank"></a>
        </li>
    <?php endif ?>
    <?php if (!empty($facebook)): ?>
        <li class="social__item is-facebook">
            <a class="social__link" title="facebook" href="<?= $facebook ?>" area-label="facebook" target="_blank"></a>
        </li>
    <?php endif ?>
    <?php if (!empty($instagram)): ?>
        <li class="social__item is-instagram">
            <a class="social__link" title="instagram" href="<?= $instagram ?>" area-label="instagram" target="_blank"></a>
        </li>
    <?php endif ?>
</ul>

