<?php

use yii\helpers\Url;

/**
 * @var \app\modules\vendor\models\Vendor[] $vendors
 * @var \app\modules\filter\forms\FilterForm $filterForm
 */

?>

<form class="js-filter-form filter" method="get" action="<?= Url::current() ?>">
    <?php if (!empty($vendors)): ?>
        <div class="filter__products">
            <div class="selection js-selection">
                <p class="selection__title">Фильтровать товары</p>
                <img class="selection__arrow js-selection-arrow" src="/img/arrow-select.svg" alt="Arrow">
            </div>
            <div class="selection__drop js-selection-drop">
                <div class="selection__header">
                    <p class="selection__title">Производитель</p>
                    <button class="selection__button js-selection-reset" type="reset">× Сбросить</button>
                </div>
                <div class="selection__body">
                    <?php foreach ($vendors as $vendor): ?>
                        <label class="checkbox">
                            <input class="checkbox__input js-filter-checkbox" type="checkbox" name="FilterForm[vendor_ids][]" value="<?= $vendor->id ?>">
                            <span class="checkbox__label"><?= $vendor->getTitle() ?></span>
                        </label>
                    <?php endforeach ?>
                </div>
                <div class="selection__footer">
                    <button class="button js-button is-wide is-selection js-selection-button" area-label="Применить" type="button">Применить</button>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="filter__products">
        <select class="select js-select js-filter-order" data-placeholder="Сначала дешёвые" data-value-with-placeholder="" name="sort">
            <option data-placeholder="true"></option>
            <option value="price">Сначала дешёвые</option>
            <option value="-price">Сначала дорогие</option>
            <option value="title">По названию</option>
        </select>
    </div>
</form>

<div class="products__loader js-products-loader">
    <img src="/img/loader.gif" alt="Loader">
</div>