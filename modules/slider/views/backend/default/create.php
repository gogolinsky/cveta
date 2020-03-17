<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\slider\models\Slide $slider
*/

$this->title = 'Добавление слайда';
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('slider')) ?>
</div>