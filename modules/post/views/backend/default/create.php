<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\post\models\Post $post
 * @var \app\modules\product\models\Product $products
*/

$this->title = 'Добавление поста';
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('post', 'products')) ?>
</div>