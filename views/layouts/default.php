<?php

use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */

?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>

    <div class="headline">
        <div class="headline__cover" style="background-image: url(/img/tools.png);">
            <div class="container">
                <div class="headline__breadcrumb">
                    <?= Breadcrumbs::widget([
                        'itemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                        'activeItemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                        'options' => ['class' => 'breadcrumb'],
                        'homeLink' => false,
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
                <?php if (isset($this->params['h1'])): ?>
                    <h1 class="headline__title"><?= $this->params['h1'] ?></h1>
                <?php endif ?>
                <?php if (isset($this->params['caption'])): ?>
                    <p class="headline__caption"><?= $this->params['caption'] ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <?= $content ?>

<?php $this->endContent() ?>
