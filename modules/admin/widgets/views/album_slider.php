<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\album\models\Album $album
 */

?>

<?php if (!empty($album->photos)): ?>

<?php endif ?>
<div class="image-slider js-image-slider">
    <div class="grid is-row is-middle">
        <div class="col-1 shift-1 is-align-right">
            <button class="image-slider__arrow is-prev js-image-slider-prev">
                <span class="arrow is-left"></span>
            </button>
        </div>
        <div class="col-8">
            <div class="image-slider__body js-image-slider-body">
                <ul class="image-slider__images js-image-slider-images">
                    <li class="image-slider__cover js-image-slider-cover"><img class="image-slider__image" src="/img/about-1.jpg" alt="alt"/></li>
                    <li class="image-slider__cover js-image-slider-cover"><img class="image-slider__image" src="/img/about-1.jpg" alt="alt"/></li>
                    <li class="image-slider__cover js-image-slider-cover"><img class="image-slider__image" src="/img/about-1.jpg" alt="alt"/></li>
                </ul>
            </div>
        </div>
        <div class="col-1">
            <button class="image-slider__arrow is-next js-image-slider-next"><span class="arrow is-right"></span>
            </button>
        </div>
    </div>
</div>
