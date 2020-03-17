<?php

use yii\widgets\Menu;

/**
 * @var \yii\web\View $this
 * @var array $items
 */

?>

<nav class="nav">
    <?= Menu::widget([
        'options' => ['class' => 'nav__list'],
        'itemOptions' => ['class' => 'nav__item'],
        'linkTemplate' => "<a class='nav__link' href='{url}' title='{label}'>{label}</a>",
        'labelTemplate' => "<span class='nav__link'>{label}</span>",
        //'activeCssClass' => 'is-active',
        'encodeLabels' => false,
        'items' => $items,
    ]) ?>
</nav>