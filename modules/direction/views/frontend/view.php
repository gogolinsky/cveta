<?php

use app\modules\filter\widgets\FilterWidget;
use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\product\widgets\ListWidget;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var \app\modules\direction\models\Direction $direction
 * @var \app\modules\product\models\Product[] $products
 */

$direction->generateMetaTags();
$this->params['breadcrumbs'][] = ['label' => 'Подбор материала', 'url' => ['index'], 'class' => 'breadcrumb__link'];
$this->params['h1'] = $direction->getH1();

?>

<?php if ($direction->background): ?>
    <div class="headline is-no-mask">
        <div class="headline__cover is-no-mask" style="background-image: url(<?= $direction->getThumbFileUrl('background') ?>);"></div>
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

                <h2 class="description__title"><?= $direction->getTitle() ?></h2>

                <?php if ($direction->content): ?>
                    <p class="description__subtitle"><?= $direction->content ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

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

<?= HelpFormWidget::widget() ?>