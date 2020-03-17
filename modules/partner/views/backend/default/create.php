<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\partner\models\Partner $partner
*/

$this->title = 'Добавление партнера';
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('partner')) ?>
</div>