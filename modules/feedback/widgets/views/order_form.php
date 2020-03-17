<?php

use app\modules\page\components\Pages;
use yii\bootstrap\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\models\Feedback $feedback
 * @var \app\modules\product\models\Product $product
 */

$privacy = Pages::getPage('privacy');

?>

<?php $form = ActiveForm::begin([
    'action' => ['/feedback/frontend/send'],
    'method' => 'POST',
    'requiredCssClass' => 'is-required',
    'options' => ['class' => 'form in-modal', 'role' => 'form'],
]) ?>
    <input type="hidden" name="type" value="<?= $feedback::TYPE ?>">
    <div class="form__body">
        <p class="form__subtitle">Заказать товар</p>
        <h3 class="form__title"><?= $product->getTitle() ?></h3>
        <div class="grid is-columns is-wide">
            <div class="col-12">
                <?= $form->field($feedback, 'name', [
                    'labelOptions' => ['class' => 'form__control'],
                    'inputOptions' => ['class' => 'input'],
                    'template' => '{beginLabel}<span class="form__label">{labelTitle}</span>{endLabel}<span class="form__field">{input}</span>'
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($feedback, 'phone', [
                    'labelOptions' => ['class' => 'form__control is-required'],
                    'inputOptions' => ['class' => 'input input-phone', 'required' => true, 'type' => 'tel', 'placeholder' => '+7 (•••) ••• •• ••'],
                    'template' => '{beginLabel}<span class="form__label">{labelTitle}</span>{endLabel}<span class="form__field">{input}</span>'
                ]) ?>
            </div>
        </div>
    </div>
    <div class="form__footer">
        <div class="form__agreement">
            <span class="form__field">
                <label class="checkbox">
                    <input class="checkbox__input is-agreement" type="checkbox" name="policy" required>
                        <span class="checkbox__label">Даю согласие на обработку <a href="<?= $privacy->getHref() ?>" target="_blank" class="button is-callback"> персональных данных</a></span>
                    </label>
            </span>
        </div>
        <div class="form__button">
            <button class="button js-button is-wide is-yellow" area-label="Позвоните мне">Позвоните мне</button>
        </div>
    </div>
<?php ActiveForm::end() ?>