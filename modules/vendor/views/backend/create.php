<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\vendor\models\Vendor $vendor
 */

$this->title = 'Добавление производителя';
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление';

?>

<div class="box box-primary">
    <?= $this->render('_form', compact('vendor')) ?>
</div>
