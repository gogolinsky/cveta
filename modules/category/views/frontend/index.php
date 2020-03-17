<?php

use app\modules\category\widgets\CategoryWidget;
use app\modules\page\components\Pages;
use app\widgets\PleasureWidget;
use app\widgets\SelectionWidget;

/**
 * @var \yii\web\View $this
 * @var \app\modules\category\models\Category[] $categories
 */

$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs();
Pages::getCurrentPage()->generateMetaTags();
$this->params['h1'] = Pages::getCurrentPage()->getH1();
$this->params['caption'] = Pages::getCurrentPage()->caption;

?>

<?php if (!empty($categories)): ?>
    <section class="section is-margin-0">
        <div class="container">
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
<?php endif ?>

<?= PleasureWidget::widget() ?>

<?= SelectionWidget::widget() ?>
