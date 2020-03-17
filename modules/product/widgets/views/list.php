<?php

use app\modules\product\widgets\ProductWidget;
use app\widgets\LinkPager;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

?>

<?php if (!empty($dataProvider->models)): ?>
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
<?php endif ?>