<?php

use app\modules\page\components\Pages;
use app\modules\vendor\widgets\VendorsWidget;

/**
 * @var yii\web\View $this
 * @var \app\modules\direction\models\Direction[] $directions
 */

$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();
$this->params['caption'] = Pages::getCurrentPage()->caption;
Pages::getCurrentPage()->generateMetaTags();

?>

<?php if (!empty($directions)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <ul class="choice">
                    <?php foreach ($directions as $direction): ?>
                        <li class="choice__item">
                            <a class="choice__link" href="<?= $direction->getHref() ?>">
                                <span class="choice__body">
                                    <img class="choice__img" src="<?= $direction->getThumbFileUrl('image') ?>" alt="<?= $direction->getTitle() ?>">
                                </span>
                                <h4 class="choice__title"><?= $direction->getTitle() ?></h4>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?= VendorsWidget::widget(['sectionClass' => 'is-m-90', 'showText' => false, 'showButtonToVendors' => false, 'limit' => 5]) ?>