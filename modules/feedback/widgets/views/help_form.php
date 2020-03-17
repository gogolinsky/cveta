<?php

use yii\bootstrap\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\forms\HelpForm $feedback
 */

?>

<section class="section is-help ">
    <div class="container">
        <div class="section__body">
            <div class="help">
                <div class="help__form">
                    <h3 class="help__headline">Нужна помощь эксперта?</h3>
                    <p class="help__info">
                        Оставьте свои контактные данные и наш специалист перезвонит
                        в течение 15 минут и проконсультирует вас абсолютно бесплатно.
                    </p>
                    <?php $form = ActiveForm::begin([
                        'action' => ['/feedback/frontend/send'],
                        'method' => 'POST',
                        'requiredCssClass' => 'is-required',
                        'options' => ['class' => 'help__feed', 'role' => "form"],
                    ]) ?>
                        <input type="hidden" name="type" value="<?= $feedback::TYPE ?>">
                        <?= $form->field($feedback, 'phone', [
                            'options' => ['tag' => false],
                            'inputOptions' => ['class' => 'help__input input-phone', 'placeholder' => 'Ваш номер телефона', 'required' => true, 'type' => 'tel'],
                            'template' => '{input}'
                        ]) ?>
                        <div class="help__button">
                            <button class="button js-button is-yellow is-help" area-label="Позвоните мне">Позвоните мне</button>
                        </div>
                    <?php ActiveForm::end() ?>
                </div>
                <div class="help__img"><img src="/img/help.png" alt="Помощь эксперта"></div>
            </div>
        </div>
    </div>
</section>