<?php

use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\service\widgets\ServiceWidget;
use app\modules\page\components\Pages;
use app\widgets\PleasureWidget;

/**
 * @var yii\web\View $this
 * @var \app\modules\service\models\Service[] $services
 */

$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();
$this->params['caption'] = Pages::getCurrentPage()->caption;
Pages::getCurrentPage()->generateMetaTags();

?>

<?php if (!empty($services)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <ul class="services">
                    <?php foreach ($services as $service): ?>
                        <li class="services__item">
                            <?= ServiceWidget::widget(compact('service')) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>

<?= PleasureWidget::widget() ?>

<?= HelpFormWidget::widget() ?>