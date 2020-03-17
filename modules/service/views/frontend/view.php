<?php

use app\helpers\ContentHelper;
use app\modules\feedback\widgets\HelpFormWidget;
use app\widgets\GuaranteesWidget;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var \app\modules\service\models\Service $service
 */

$service->generateMetaTags();

$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index'], 'class' => 'breadcrumb__link'];
$this->params['h1'] = $service->getH1();

?>

<?php if ($service->background): ?>
    <div class="headline is-no-mask">
        <div class="headline__cover is-no-mask" style="background-image: url(<?= $service->getThumbFileUrl('background') ?>)"></div>
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

                <h2 class="description__title"><?= $service->getTitle() ?></h2>

                <?php if ($service->content): ?>
                    <div class="description__subtitle"><?= $service->content ?></div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="more grid is-row">
                <div class="more__left col-4">
                    <?php if ($service->slogan): ?>
                        <p class="more__subtitle">Точно в цвет</p>
                    <?php endif ?>

                    <h3 class="more__title"><?= $service->getTitle() ?></h3>

                    <?php if ($service->price): ?>
                        <div class="more__order">
                            <p class="more__caption">Стоимость:</p>
                            <p class="more__cost"><?= $service->price ?></p>
                        </div>
                    <?php endif ?>
                </div>
                <div class="more__right col-8">
                    <?php if ($service->features): ?>
                        <ul class="more__list">
                            <?php foreach (ContentHelper::splitText($service->features) as $feature): ?>
                                <li class="more__item"><?= $feature ?></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
                <?php if ($service->price_list): ?>
                    <div class="more__costs col-10 shift-1">
                        <table class="more__table">
                            <caption class="more__headline">Стоимость</caption>
                            <?php foreach ($service->getPrices() as $price): ?>
                                <tr class="more__table-row">
                                    <td class="more__table-col"><?= $price['title'] ?></td>
                                    <td class="more__table-col"><?= $price['value'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<?= GuaranteesWidget::widget() ?>

<?= HelpFormWidget::widget() ?>