<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\page\models\Page[] $pages
 */

?>


<div class="box box-primary">
    <div class="box-header with-border" data-widget="collapse">
        <h3 class="box-title" >Страницы</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php foreach ($pages as $page): ?>
                <li class="item">
                    <div>
                        <a href="<?= Url::to(['/page/backend/default/update', 'id' => $page->id]) ?>" class="product-title"><?= $page->title ?></a>
                        <span class="product-description">
                          <?= $page->alias ?>
                        </span>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="<?= Url::to(['/page/backend/default/index']) ?>" class="uppercase">Посмотреть все страницы</a>
    </div>
    <!-- /.box-footer -->
</div>

