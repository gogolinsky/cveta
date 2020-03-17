<?php

use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\page\components\Pages;

/**
 * @var \yii\web\View $this
 * @var \app\modules\vendor\models\Vendor[] $vendors
 */

Pages::getCurrentPage()->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();

?>

<?php if (!empty($vendors)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <ul class="vendors is-big">
                    <?php foreach ($vendors as $vendor): ?>
                        <li class="vendors__item">
                            <a class="vendor__link" href="<?= $vendor->getHref() ?>">
                                <img class="vendor" src="<?= $vendor->getThumbFileUrl('image') ?>" alt="<?= $vendor->getTitle() ?>">
                                <p class="vendor__caption"><?= $vendor->hint ?></p>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?= HelpFormWidget::widget() ?>
