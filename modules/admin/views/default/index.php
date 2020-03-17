<?php

use app\modules\feedback\widgets\FeedbackBoxWidget;
use app\modules\page\widgets\PagesBoxWidget;
use app\modules\product\widgets\ProductsBoxWidget;

?>

<div class="row">
    <div class="col-xs-12 col-lg-4">
        <?= PagesBoxWidget::widget() ?>
    </div>
    <div class="col-xs-12 col-lg-4">
        <?= FeedbackBoxWidget::widget() ?>
    </div>
    <div class="col-xs-12 col-lg-4">
        <?= ProductsBoxWidget::widget() ?>
    </div>
</div>
