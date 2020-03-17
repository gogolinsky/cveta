<?php

use app\modules\employee\widgets\EmployeeWidget;
use app\modules\page\components\Pages;
use app\widgets\MapWidget;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var \app\modules\employee\models\Employee[] $employees
 * @var \app\modules\partner\models\Partner[] $partners
 * @var \app\modules\cert\models\Cert[] $certs
 */

Pages::getCurrentPage()->generateMetaTags();

?>

<div class="headline is-small">
    <div class="headline__cover is-small">
        <div class="container">
            <div class="headline__breadcrumb">
                <?= Breadcrumbs::widget([
                    'itemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                    'activeItemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                    'options' => ['class' => 'breadcrumb'],
                    'homeLink' =>  [
                        'label' => 'Главная',
                        'title' => 'Главная',
                        'url' => ['/site/index'],
                        'class' => 'breadcrumb__link',
                    ],
                    'links' => $this->params['breadcrumbs'] ?? [],
                ]) ?>
            </div>
            <h1 class="headline__title"><?= Pages::getCurrentPage()->getH1() ?></h1>
        </div>
    </div>
    <div class="headline__case">
        <img src="/img/about.jpg" alt="Мастерская цвета">
    </div>
</div>

<section class="section is-m-60">
    <div class="container">
        <div class="section__body">
            <div class="text is-post">
                <?= Pages::getCurrentPage()->content ?>
            </div>
            <div class="post__gallery grid is-row">
                <img class="col-6" src="/img/post-1.jpg" alt="">
                <img class="col-6" src="/img/post-2.jpg" alt="">
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section__body">
            <div class="stages">
                <div class="stages__body">
                    <h2 class="stages__headline">Как мы работаем</h2>
                    <p class="stages__text">Последовательность выполнения заказа</p>
                    <button class="button js-button is-yellow is-wide" area-label="Заказать интсрукцию" data-modal="callback">Бесплатная консультация</button>
                </div>
                <div class="stages__slider">
                    <div class="stages js-stages">
                        <div class="stages__inner">
                            <div class="stages__container js-stages-container">
                                <div class="stages__wrapper js-stages-wrapper">
                                    <div class="stages__item js-stages-item">
                                        <div class="stages__img js-stages-img">
                                            <img src="/img/stage-slider.png" alt="">
                                        </div>
                                        <div class="stages__description is-fade">
                                            <p class="stages__number">01</p>
                                            <h3 class="stages__title">Консультация</h3>
                                            <p class="stages__subtite">Проводим консультацию, непосредственно в самом магазине. Производим подбор и расчет оптимального продукта.</p>
                                        </div>
                                    </div>
                                    <div class="stages__item js-stages-item">
                                        <div class="stages__img js-stages-img">
                                            <img src="/img/post-1.jpg" alt="">
                                        </div>
                                        <div class="stages__description is-fade">
                                            <p class="stages__number">02</p>
                                            <h3 class="stages__title">Выбор цвета</h3>
                                            <p class="stages__subtite">Проводим консультацию, непосредственно в самом магазине. Производим подбор и расчет оптимального продукта.</p>
                                        </div>
                                    </div>
                                    <div class="stages__item js-stages-item">
                                        <div class="stages__img js-stages-img">
                                            <img src="/img/stage-slider.png" alt="">
                                        </div>
                                        <div class="stages__description is-fade">
                                            <p class="stages__number">03</p>
                                            <h3 class="stages__title">Покраска</h3>
                                            <p class="stages__subtite">Проводим консультацию, непосредственно в самом магазине. Производим подбор и расчет оптимального продукта.</p>
                                        </div>
                                    </div>
                                    <div class="stages__item js-stages-item">
                                        <div class="stages__img js-stages-img">
                                            <img src="/img/stage-slider.png" alt="">
                                        </div>
                                        <div class="stages__description is-fade">
                                            <p class="stages__number">04</p>
                                            <h3 class="stages__title">Всё!</h3>
                                            <p class="stages__subtite">Проводим консультацию, непосредственно в самом магазине. Производим подбор и расчет оптимального продукта.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="stages__pagination"></div>
                                <svg class="stages__progress" viewBox="0 0 470 574" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="circle js-stages-progress" opacity="1" d="M1 70.198C50.7852 27.675 115.394 2 186 2C343.401 2 471 129.599 471 287C471 444.401 343.401 572 186 572C115.394 572 50.7852 546.325 1 503.802" stroke="#6B83DA" stroke-width="3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($employees)): ?>
    <section class="section is-blue">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Наша команда</h2>
            </header>
            <div class="section__body">
                <ul class="team grid is-row">
                    <?php foreach ($employees as $employee): ?>
                        <li class="team__item col-4">
                            <?= EmployeeWidget::widget(compact('employee')) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($partners)): ?>
    <section class="section">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Наши партнеры</h2>
            </header>
            <div class="section__body">
                <ul class="vendors">
                    <?php foreach ($partners as $partner): ?>
                        <li class="vendors__item">
                            <a class="vendor__link" href="<?= $partner->link ?: '#' ?>" target="_blank">
                                <img class="vendor" src="<?= $partner->getThumbFileUrl('image') ?>" alt="<?= $partner->getTitle() ?>">
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($certs)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Вся продукция сертифицированна</h2>
            </header>
            <div class="section__body">
                <ul class="cerfs js-cerfs">
                    <?php foreach ($certs as $cert): ?>
                        <li class="cerfs__item">
                            <div class="cerf">
                                <div class="cerf__img">
                                    <a href="<?= $cert->getThumbFileUrl('image') ?>" data-fancybox="cerf" class="js-cerf-img">
                                        <img src="<?= $cert->getThumbFileUrl('image') ?>" alt="<?= $cert->getTitle() ?>">
                                    </a>
                                </div>
                                <p class="cerf__title"><?= $cert->getTitle() ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?= MapWidget::widget() ?>

<section class="section is-begin is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="begin">
                <div class="begin__info">
                    <h3 class="begin__title">С чего же начать выбор?</h3>
                    <p class="begin__subtitle">С подбора применения и выбора цвета, а поможет вам в этом наш интерактивный помощник.</p>
                    <div class="begin__button">
                        <button class="button js-button is-yellow" area-label="Подобрать материал">Подобрать материал</button>
                    </div>
                </div><img class="begin__img" src="/img/begin-pattern.png" alt="">
            </div>
        </div>
    </div>
</section>