<?php

use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\page\components\Pages;
use app\modules\product\widgets\ProductWidget;
use app\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var \app\modules\vendor\models\Vendor $vendor
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$vendor->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('vendors');
$this->params['h1'] = $vendor->getH1();

?>

<?php if ($vendor->background): ?>
    <div class="headline is-no-mask">
        <div class="headline__cover is-no-mask" style="background-image: url(<?= $vendor->getThumbFileUrl('background') ?>);">
            <div class="container">
                <div class="headline__brand">
                    <img class="headline__brand-img" src="<?= $vendor->getThumbFileUrl('image') ?>" alt="<?= $vendor->getTitle() ?>">
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="description">
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

                <h2 class="description__title">Материалы <?= $vendor->getTitle() ?></h2>
                <p class="description__subtitle"><?= $vendor->content ?></p>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($dataProvider->models)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <div class="products__loader js-products-loader">
                    <img src="img/loader.gif" alt="Loader">
                </div>
                <div class="products" id="products">
                    <ul class="products__list grid is-row">
                        <?php foreach ($dataProvider->models as $product): ?>
                            <li class="products__item col-3">
                                <?= ProductWidget::widget(compact('product')) ?>
                            </li>
                        <?php endforeach ?>
                    </ul>

                    <?php if ($dataProvider->pagination->pageCount > 1): ?>
                        <div class="pagination">
                            <?= LinkPager::widget([
                                'pagination' => $dataProvider->pagination,
                                'firstPageLabel' => false,
                                'lastPageLabel' => false,
                                'nextPageLabel' => '<span>Показать ещё</span><a class="arrow">',
                                'prevPageLabel' => false,
                                'disableCurrentPageButton' => true,
                                'options' => ['class' => 'pagination__list'],
                                'pageCssClass' => 'pagination__item',
                                'linkOptions' => ['class' => 'pagination__link'],
                                'activePageCssClass' => 'is-current',
                                'disabledPageCssClass' => 'is-disabled',
                                'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'pagination__label'],
                                'prevPageCssClass' => 'pagination__item is-prev',
                                'nextPageCssClass' => 'pagination__item is-next',
                                'nextLinkOptions' => ['class' => ''],
                            ]) ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?= HelpFormWidget::widget() ?>