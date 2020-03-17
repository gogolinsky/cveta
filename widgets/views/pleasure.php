<?php

use app\modules\setting\components\Settings;

/**
 * @var \yii\web\View $this
 */

?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="quote grid is-row">
                <div class="quote__header col-3">
                    <p class="quote__subtitle">Мастерская Цвета</p>
                    <h3 class="quote__title">Мы всегда готовы помочь...</h3>
                </div>
                <div class="quote__body col-8 shift-1">
                    <div class="text">
                        <?= Settings::getRealValue('pleasure') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
