<?php

use app\modules\category\widgets\CategoryWidget;
use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\page\components\Pages;
use app\modules\post\widgets\PostWidget;
use app\modules\project\widgets\ProjectWidget;
use app\modules\service\widgets\ServicesWidget;
use app\modules\setting\components\Settings;
use app\modules\slider\widgets\SliderWidget;
use app\modules\vendor\widgets\VendorsWidget;
use app\widgets\GuaranteesWidget;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\project\models\Project[] $projects
 * @var \app\modules\partner\models\Partner[] $partners
 * @var \app\modules\post\models\Post[] $posts
 */

Pages::getCurrentPage()->generateMetaTags();

?>

<?= SliderWidget::widget() ?>

<section class="section is-blue is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="about">
                <img src="/img/forall.png" alt="Стол" class="about__forall">
                <div class="about__left">
                    <h2 class="about__headline">Мастерская Цвета</h2>
                    <p class="about__text"><?= nl2br(Settings::getRealValue('about')) ?></p>
                    <div class="about__button">
                        <a class="button js-button is-callback fz-16" area-label="Подробнее о нас" href="<?= Url::to(['/site/about']) ?>">Подробнее о нас</a>
                    </div>
                </div>
                <img class="about__img" src="/img/about.png" alt="Мастерская цвета">
                <div class="about__shadow"></div>
            </div>
        </div>
    </div>
</section>

<?= ServicesWidget::widget() ?>

<?php if (!empty($categories)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Каталог товаров</h2>
            </header>
            <div class="section__body">
                <ul class="catalog">
                    <?php foreach ($categories as $category): ?>
                        <li class="catalog__item">
                            <?= CategoryWidget::widget(compact('category')) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php  endif ?>

<?= HelpFormWidget::widget() ?>

<?= GuaranteesWidget::widget() ?>

<?php if (!empty($projects)): ?>
    <section class="section">
        <div class="container">
            <div class="section__body">
                <div class="roll js-roll">
                    <div class="roll__inner">
                        <div class="roll__header">
                            <h3 class="roll__headline">Нашими красками покрашены</h3>
                            <div class="roll__arrow">
                                <a class="roll-button-prev arrow"></a>
                                <a class="roll-button-next arrow"></a>
                            </div>
                        </div>
                        <div class="roll__container js-roll-container">
                            <div class="roll__wrapper js-roll-wrapper">
                                <?php foreach ($projects as $project): ?>
                                    <div class="roll__item js-roll-item">
                                        <?= ProjectWidget::widget(compact('project')) ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?= VendorsWidget::widget() ?>

<?php if (!empty($posts)): ?>
    <section class="section is-blue is-padding-0 is-margin-0">
        <div class="container">
            <div class="section__body">
                <div class="last-news js-last">
                    <div class="last-news__inner">
                        <div class="last-news__header">
                            <h3 class="last-news__headline">Последние новости и события</h3>
                            <div class="last-news__arrow">
                                <a class="last-button-prev arrow"></a>
                                <a class="last-button-next arrow"></a>
                            </div>
                        </div>
                        <div class="last-news__container js-last-container">
                            <div class="last-news__wrapper js-last-wrapper">
                                <?php foreach ($posts as $post): ?>
                                    <div class="last-news__item js-last-item">
                                        <?= PostWidget::widget(compact('post')) ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<section class="section is-begin is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="begin">
                <div class="begin__info">
                    <h3 class="begin__title">С чего же начать выбор?</h3>
                    <p class="begin__subtitle">С подбора применения и выбора цвета, а поможет вам в этом наш интерактивный помощник.</p>
                    <div class="begin__button">
                        <a href="<?= Url::to(['/direction/frontend/index']) ?>" class="button js-button is-yellow" area-label="Подобрать материал">Подобрать материал</a>
                    </div>
                </div><img class="begin__img" src="/img/begin-pattern.png" alt="">
            </div>
        </div>
    </div>
</section>