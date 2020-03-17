<?php

use app\helpers\FormatHelper;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\models\Feedback $feedback
 */

?>

<table border=1 cellspacing="0" cellpadding="5" style="border: 2px solid #000">
    <tr><td>Форма</td><td><?= $feedback::TITLE ?></td></tr>
    <?php if (!empty($feedback->item_id)): ?>
        <tr>
            <td><?= $feedback->getAttributeLabel('item_id') ?></td>
        </tr>
    <?php endif ?>
    <?php if (!empty($feedback->name)): ?>
        <tr>
            <td>Имя</td>
            <td><?= Html::encode($feedback->name) ?></td>
        </tr>
    <?php endif ?>
    <?php if (!empty($feedback->phone)): ?>
        <tr>
            <td>Телефон</td>
            <td><?= Html::encode($feedback->phone) ?></td>
        </tr>
    <?php endif ?>
    <?php if (!empty($feedback->comment)): ?>
        <tr>
            <td>Комментарий</td>
            <td><?= FormatHelper::nText($feedback->comment) ?></td>
        </tr>
    <?php endif ?>
    <?php if (!empty($feedback->ref)): ?>
        <tr>
            <td>Страница</td>
            <td><a href="<?= $feedback->ref ?>" target="_blank"><?= $feedback->ref ?></a></td>
        </tr>
    <?php endif ?>
</table>
