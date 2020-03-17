<?php

use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\page\components\Pages;
use app\modules\promo\widgets\PromoWidget;

/**
 * @var yii\web\View $this
 * @var \app\modules\promo\models\Promo[] $promos
 */

$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();
$this->params['caption'] = Pages::getCurrentPage()->caption;
Pages::getCurrentPage()->generateMetaTags();

?>

<?php if (!empty($promos)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <ul class="services">
                    <?php foreach ($promos as $promo): ?>
                        <li class="services__item">
                            <?= PromoWidget::widget(compact('promo')) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?= HelpFormWidget::widget() ?>