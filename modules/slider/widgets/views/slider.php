<?php

/**
 * @var \app\modules\slider\models\Slide[] $slides
 */

?>

<?php if (!empty($slides)): ?>
    <div class="slider js-slider">
        <div class="slider__inner">
            <div class="slider__container js-slider-container">
                <div class="slider__wrapper js-slider-wrapper">
                    <?php foreach ($slides as $slide): ?>
                        <div class="slider__image js-slider-image">
                            <div class="slider__img" style="background-image: url(<?= $slide->getThumbFileUrl('image') ?>);"></div>
                            <div class="container">
                                <div class="slider__content">
                                    <h2 class="slider__headline"><?= $slide->title ?></h2>
                                    <p class="slider__text"><?= $slide->description ?></p>
                                    <?php if (!empty($slide->link)): ?>
                                        <div class="slider__button">
                                            <a class="button js-button is-yellow" area-label="Подобрать материалы" href="<?= $slide->link ?>">Подобрать материал</a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="slider__advantages">
                <div class="advantages">
                    <ul class="advantages__list">
                        <li class="advantages__item">
                            <img class="advantages__img" src="/img/advantages-1.svg" alt="Разбираемся в краске уже 15 лет">
                            <p class="advantages__text">Разбираемся в краске уже 15 лет</p>
                        </li>
                        <li class="advantages__item is-center">
                            <img class="advantages__img" src="/img/advantages-3.svg" alt="Более 1000 довольных клиентов">
                            <p class="advantages__text">Более 1000 довольных клиентов</p>
                        </li>
                        <li class="advantages__item">
                            <img class="advantages__img" src="/img/advantages-2.svg" alt="Покрасили более 10 000 м2">
                            <p class="advantages__text">Покрасили более 10 000 м2</p>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if (sizeof($slides) > 1): ?>
                <div class="slider__arrow">
                    <div class="slider-button-next"></div>
                    <div class="slider-button-prev"></div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>
