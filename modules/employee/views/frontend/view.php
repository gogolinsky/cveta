<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\employee\models\Employee $employee
 */

?>

<div class="container">
    <div class="modal__employee">
        <div class="employee employee-big">
            <div class="employee__header">
                <img class="employee__img" src="<?= $employee->getThumbFileUrl('image') ?>" alt="<?= $employee->getTitle() ?>">
            </div>
            <div class="employee__body">
                <p class="employee__position"><?= $employee->post ?></p>
                <div class="employee__name"><?= $employee->getTitle() ?></div>
                <div class="employee__description-big">
                    <?= $employee->content ?>
                </div>
                <div class="employee__button">
                    <button class="button js-button is-bordered" area-label="Вернуться назад" data-modal-close>Вернуться назад</button>
                </div>
            </div>
            <div class="employee__shadow"></div>
        </div>
    </div>
</div>
