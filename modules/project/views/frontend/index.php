<?php

use app\modules\feedback\widgets\HelpFormWidget;
use app\modules\page\components\Pages;
use app\modules\project\widgets\ProjectWidget;
use app\widgets\LinkPager;

/**
 * @var yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs();
$this->params['h1'] = Pages::getCurrentPage()->getH1();
$this->params['caption'] = Pages::getCurrentPage()->caption;
Pages::getCurrentPage()->generateMetaTags();

?>

<?php if (!empty($dataProvider->models)): ?>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <ul class="services is-portfolio">
                    <?php foreach ($dataProvider->models as $project): ?>
                        <li class="services__item">
                            <?= ProjectWidget::widget(compact('project')) ?>
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
    </section>
<?php endif ?>

<?= HelpFormWidget::widget() ?>