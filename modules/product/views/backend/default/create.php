<?php

/**
 * @var yii\web\View $this
 * @var app\modules\product\models\Product $product
 */

$this->title = 'Добавление товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-primary">
    <?= $this->render('_form', compact('product', 'directions')) ?>
</div>


