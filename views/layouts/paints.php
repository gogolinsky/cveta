<?php

use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */

?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>

    <div class="headline is-painting js-headline">
        <div class="headline__cover js-headline-picker is-ready">
            <div class="container">
                <div class="headline__painting">
                    <button class="button js-button is-choice" area-label="Выбрать цвет" data-modal="colorPicker">Выбрать цвет</button>
                </div>
                <img class="headline__img" src="/img/table.png" alt="Стол">
            </div>
        </div>
    </div>
    <section class="section is-margin-0">
        <div class="container">
            <div class="section__body">
                <div class="description">
                    <?= Breadcrumbs::widget([
                        'itemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                        'activeItemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                        'options' => ['class' => 'breadcrumb'],
                        'homeLink' => false,
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?php if (isset($this->params['h1'])): ?>
                        <h1 class="headline__title"><?= $this->params['h1'] ?></h1>
                    <?php endif ?>
                    <?php if (isset($this->params['caption'])): ?>
                        <p class="headline__caption"><?= $this->params['caption'] ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>

    <?= $content ?>

<?php $this->endContent() ?>
