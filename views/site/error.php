<?php

/**
 * @var \yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

$this->title = 'Страница не найдена';

?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="not-found">
                <h3 class="not-found__headline">Страница не найдена</h3>
                <div class="not-found__button">
                    <a class="button js-button is-not" area-label="Перейти на главную" href="/">Перейти на главную</a>
                </div>
            </div>
        </div>
    </div>
</section>
