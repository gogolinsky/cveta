<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\product\models\Variation $variation
 */

$this->title = 'Добавить вариацию';

?>

<?= $this->render('_form', compact('variation')); ?>
