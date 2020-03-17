<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\product\models\Product[] $products
 */

 ?>

<div class="box box-primary">
    <div class="box-header with-border" data-widget="collapse">
        <h3 class="box-title">Товары</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">

        <ul class="products-list product-list-in-box">
            <?php foreach ($products as $product): ?>
                <li class="item">
                    <?php if ($product->hasImage()): ?>
                        <div class="product-img">
                            <img src="<?= $product->getThumbFileUrl('image') ?>" alt="<?= $product->getTitle() ?>">
                        </div>
                    <?php endif ?>

                    <div <?= $product->hasImage() ? 'class="product-info"' : '' ?>>
                        <a href="<?= Url::to(['/product/backend/default/update', 'id' => $product->id]) ?>" class="product-title"><?= $product->getTitle() ?></a>
                        <span class="product-description">
                          <?= $product->category->title ?>
                        </span>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>

    </div>
    <div class="box-footer text-center">
        <a href="<?= Url::to(['/product/backend/default/index'])?>" class="uppercase" data-pjax="0">Посмотреть все товары</a>
    </div>
</div>
