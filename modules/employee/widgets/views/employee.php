<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\employee\models\Employee $employee
 */

?>

<div class="employee js-employee">
    <div class="employee__header">
        <img class="employee__img" src="<?= $employee->getThumbFileUrl('image') ?>" alt="<?= $employee->getTitle() ?>">
    </div>
    <div class="employee__body">
        <div class="employee__name"><?= $employee->getTitle() ?></div>
        <div class="employee__description"><?= $employee->description ?></div>
        <div class="employee__link">
            <button class="button js-employee-button is-callback" area-label="Подробнее" data-scr="<?= Url::to(['/employee/frontend/view', 'id' => $employee->id]) ?>" data-modal="employee">Подробнее</button>
        </div>
    </div>
    <div class="employee__shadow"></div>
</div>
