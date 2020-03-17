<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\direction\models\Direction $direction
*/

$this->title = 'Добавление напрвыления';
$this->params['breadcrumbs'][] = ['label' => 'Направления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('direction')) ?>
</div>