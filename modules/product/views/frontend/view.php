<?php

use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\page\components\Pages;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var \app\modules\product\models\Product $product
 * @var \app\modules\product\models\Variation[] $variations
 * @var \app\modules\category\models\Category $category
 * @var \app\modules\category\models\Category[] $parents
 * @var \app\modules\eav\models\EavAttribute[] $options
 * @var \app\modules\vendor\models\Vendor $vendor
 * @var \app\modules\product\models\ProductImage[] $images
 */

$product->generateMetaTags();
$this->params['h1'] = $product->getH1();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('catalog');

foreach ($parents as $parent) {
    $this->params['breadcrumbs'][] = [
        'label' => $parent->getTitle(),
        'url' => $parent->getHref(),
        'class' => 'breadcrumb__link',
    ];
}

$this->params['breadcrumbs'][] = [
    'label' => $category->getTitle(),
    'url' => $category->getHref(),
    'class' => 'breadcrumb__link',
];

$this->params['product'] = $product; // Для формы заказа в layout main

?>

<div class="product-card">
    <div class="container">
        <div class="grid is-row">
            <div class="col-6">
                <?php if (!empty($images)): ?>
                    <div class="product-slider js-product-slider">
                        <div class="product-slider__inner">
                            <div class="product-slider__container js-product-slider-container">
                                <div class="product-slider__wrapper js-product-slider-wrapper">
                                    <?php foreach ($images as $image): ?>
                                        <div class="product-slider__image js-product-slider-image">
                                            <img src="<?= $image->getThumbFileUrl('image') ?>" alt="<?= $product->getTitle() ?>" />
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="product-slider__control">
                                <a class="product-slider-prev is-reverse arrow"></a>
                                <a class="product-slider-next arrow"></a>
                            </div>
                            <div class="product-slider__list js-product-slider-thumbnails">
                                <ul class="product-slider__wrapper js-product-slider-wrapper is-roll">
                                    <?php foreach ($images as $image): ?>
                                        <li class="product-slider__item js-product-slider-item">
                                            <img src="<?= $image->getThumbFileUrl('image', 'icon') ?>" />
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-6">
                <div class="product-card__info">
                    <?= Breadcrumbs::widget([
                        'itemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                        'activeItemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                        'options' => ['class' => 'breadcrumb'],
                        'homeLink' => false,
                        'links' => $this->params['breadcrumbs'] ?? [],
                    ]) ?>
                    <h2 class="product-card__name"><?= $product->getTitle() ?></h2>
                    <div class="product-card__description"><?= $product->description ?></div>
                    <div class="product-card__features">
                        <div class="product-card__vendor">
                            <div class="product-card__company">
                                <p class="product-card__manufacturer">Производитель</p>
                                <a href="<?= $vendor->getHref() ?>" class="button js-button is-callback" area-label="<?= $vendor->getTitle() ?>"><?= $vendor->getTitle() ?></a>
                            </div>
                            <div class="product-card__logo">
	                            <a href="<?= $vendor->getHref() ?>">
		                            <img src="<?= $vendor->getThumbFileUrl('image') ?>" alt="<?= $vendor->getTitle() ?>">
	                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="form form-other">
                        <?php if (!empty($variations)): ?>
                            <label class="product-card__control">
                                <span class="product-card__field">
                                    <select class="select js-select" data-placeholder=" " data-value-with-placeholder="" name="">
                                        <option data-placeholder="true"></option>
                                        <?php foreach ($variations as $variation): ?>
                                            <option value="<?= $variation->id ?>"><?= $variation->getTitle() ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </span>
                            </label>
                        <?php endif ?>
                        <div class="product-card__button">
                            <button class="button js-button is-yellow is-wide" data-modal="order"  area-label="Сделать заказ">Сделать заказ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= HelpFormWidget::widget() ?>
