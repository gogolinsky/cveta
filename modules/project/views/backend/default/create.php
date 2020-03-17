<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\project\models\Project $project
 * @var \app\modules\product\models\Product $products
*/

$this->title = 'Добавление проекта';
$this->params['breadcrumbs'][] = ['label' => 'Портфолио', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('project', 'products', 'employees')) ?>
</div>