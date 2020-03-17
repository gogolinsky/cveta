<?php

use app\helpers\ContentHelper;
use app\modules\employee\widgets\EmployeeWidget;
use app\modules\product\widgets\ProductWidget;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var \app\modules\project\models\Project $project
 * @var \app\modules\project\models\Project $nextProject
 * @var \app\modules\product\models\Product[] $products
 * @var \app\modules\employee\models\Employee[] $employees
 * @var \app\modules\project\models\ProjectImage[] $images
 */

$project->generateMetaTags();
$this->params['breadcrumbs'][] = ['label' => 'Портфолио', 'url' => ['index'], 'class' => 'breadcrumb__link'];

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
            <h1 class="headline__title"><?= $project->getH1() ?></h1>
        </div>
    </div>
    <div class="headline__case">
        <img src="<?= $project->getThumbFileUrl('image', 'origin') ?>" alt="<?= $project->getTitle() ?>">
    </div>
</div>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="date">
                <?php if ($project->description): ?>
                    <div class="date__description">
                        <p class="date__subtitle">Описание проекта:</p>
                        <div class="date__title"><?= $project->description ?></div>
                    </div>
                <?php endif ?>
                <?php if ($project->date): ?>
                    <div class="date__time">
                        <p class="date__subtitle">Дата сдачи:</p>
                        <time class="date__title"><?= $project->date ?></time>
                    </div>
                <?php endif ?>
            </div>
            <div class="more grid is-row is-case">
                <div class="more__left col-4">
                    <?php if ($project->task): ?>
                        <h3 class="more__title">Поставленная задача</h3>
                        <p class="more__description"><?= $project->task ?></p>
                    <?php endif ?>
                </div>
                <div class="more__right col-8">
                    <?php if ($project->works): ?>
                        <ul class="more__list">
                            <?php foreach (ContentHelper::splitText($project->works) as $work): ?>
                                <li class="more__item"><?= $work ?></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($images)): ?>
    <section class="section">
        <div class="container">
            <div class="section__body">
                <div class="roll js-roll">
                    <div class="roll__inner">
                        <div class="roll__header">
                            <h3 class="roll__headline">Галерея проекта</h3>
                            <div class="roll__arrow">
                                <button class="roll-button-prev arrow"></button>
                                <button class="roll-button-next arrow"></button>
                            </div>
                        </div>
                        <div class="roll__container js-roll-container">
                            <div class="roll__wrapper js-roll-wrapper">
                                <?php foreach ($images as $image): ?>
                                    <div class="roll__item js-roll-item">
                                        <img src="<?= $image->getThumbFileUrl('image') ?>" alt="">
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

<?php if ($project->review_text): ?>
    <section class="section is-margin-0 is-review">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Отзыв заказчика</h2>
            </header>
            <div class="section__body">
                <div class="grid">
                    <div class="review">
                        <div class="review__body">
                            <p class="review__text"><?= $project->review_text ?></p>
                            <div class="review__people">
                                <p class="review__position"><?= $project->review_post ?></p>
                                <p class="review__name"><?= $project->review_name ?></p>
                            </div>
                        </div><img class="review__img" src="<?= $project->getThumbFileUrl('review_image') ?>" alt="<?= $project->review_name ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($employees)): ?>
    <section class="section is-left">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">Активно участвовали в проекте</h2>
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

<?php if (!empty($products)): ?>
    <section class="section is-left is-margin-0">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">В проекте были задействованы</h2>
            </header>
            <div class="section__body">
                <div class="products__loader js-products-loader">
                    <img src="/img/loader.gif" alt="loader">
                </div>
                <div class="products js-products">
                    <ul class="products__list grid is-row">
                        <?php foreach ($products as $product): ?>
                            <li class="products__item col-3">
                                <?= ProductWidget::widget(compact('product')) ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="jump">
                <a href="<?= Url::to(['index']) ?>" class="button js-button is-bordered is-dis" area-label="←&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;Назад в портфолио">←&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Назад в портфолио</a>
                <a href="<?= $nextProject->getHref() ?>" class="button js-button is-bordered is-promo" area-label="Следующий проект&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;→">Следующий проект&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;→</a>
            </div>
        </div>
    </div>
</section>