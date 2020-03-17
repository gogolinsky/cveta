<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\product\models\Product $product
 * @var yii\widgets\ActiveForm $form
 */

?>

<?php $this->beginContent('@app/modules/product/views/backend/default/layout.php', ['product' => $product]); ?>

    <?= $this->render('_form', compact('product', 'directions')) ?>

<?php $this->endContent() ?>

