<?php

use app\helpers\DecorHelper;

/**
 * @var \app\modules\product\models\Product $product
 * @var string $image
 */

?>

<?php if (!empty($product)): ?>
    <article class="product">
        <a href="<?= $product->getHref() ?>">
            <img class="product__img" src="<?= $product->getThumbFileUrl('image') ?>" alt="<?= $product->getTitle() ?>">
            <h3 class="product__name"><?= $product->getTitle() ?></h3>
            <p class="product__description"><?= $product->hint ?></p>
            <p class="product__order"><?= DecorHelper::price($product->getPrice()) ?></p>
        </a>
    </article>
<?php endif ?>
