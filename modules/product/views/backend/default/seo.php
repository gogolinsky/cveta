<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var \app\modules\product\models\Product $product
 */

?>

<?php $this->beginContent('@app/modules/product/views/backend/default/layout.php', ['product' => $product, 'breadcrumbs' => ['SEO']]) ?>
<?php $form = ActiveForm::begin() ?>
    <div class="box-body">
        <?= $form->field($product, 'h1') ?>
        <?= $form->field($product, 'meta_t') ?>
        <?= $form->field($product, 'meta_d')->textarea(['rows' => 5]) ?>
        <?= $form->field($product, 'meta_k')->hint('Фразы через запятую') ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php $form::end() ?>
<?php $this->endContent() ?>