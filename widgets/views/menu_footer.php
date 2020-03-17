<?php

use yii\widgets\Menu;

/**
 * @var \yii\web\View $this
 * @var array $items
 */

?>

<?= Menu::widget([
    'options' => ['class' => 'footer-nav'],
    'itemOptions' => ['class' => 'footer-nav__item'],
    'linkTemplate' => "<a class='footer-nav__link' href='{url}' title='{label}'>{label}</a>",
    'labelTemplate' => "<span class='footer-nav__link'>{label}</span>",
    //'activeCssClass' => 'is-active',
    'encodeLabels' => false,
    'items' => $items,
]) ?>