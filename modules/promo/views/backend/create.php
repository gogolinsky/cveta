<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\promo\models\Promo $promo
*/

$this->title = 'Добавление услуги';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('promo')) ?>
</div>