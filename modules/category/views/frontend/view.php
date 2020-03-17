<?php

use app\modules\page\components\Pages;
use app\modules\product\widgets\ListWidget;
use app\widgets\PleasureWidget;
use app\widgets\SelectionWidget;
use app\modules\filter\widgets\FilterWidget;

/**
 * @var \yii\web\View $this
 * @var \app\modules\category\models\Category $category
 * @var \app\modules\category\models\Category[] $parents
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\category\models\Category[] $children
 * @var \app\modules\filter\forms\FilterForm $filterForm
 */

$category->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('catalog');

foreach ($parents as $parent) {
    $this->params['breadcrumbs'][] = [
        'label' => $parent->getTitle(),
        'url' => $parent->getHref(),
        'class' => 'breadcrumb__link',
    ];
}

$this->params['h1'] = $category->getH1();
$this->params['caption'] = $category->caption;

?>

<?php if (!empty($children)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <ul class="catalog is-big">
                    <?php foreach ($children as $child): ?>
                        <li class="catalog__item">
                            <a class="catalog__link" href="<?= $child->getHref() ?>">
                                <h4 class="catalog__name"><?= $child->getTitle() ?></h4>
                                <p class="catalog__sign"><?= $child->hint ?></p>
                                <div class="catalog__img">
                                    <img src="<?= $child->getThumbFileUrl('image') ?>" alt="<?= $child->getTitle() ?>">
                                </div>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
                <?php if (!empty($category->content)): ?>
                    <div class="text">
                        <?= $category->content ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>
<?php endif ?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <?= FilterWidget::widget(compact('filterForm')) ?>

            <div class="products js-products">
                <?= ListWidget::widget(compact('dataProvider')) ?>
            </div>
        </div>
    </div>
</section>

<?= PleasureWidget::widget() ?>

<?= SelectionWidget::widget() ?>