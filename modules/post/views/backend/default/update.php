<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\post\models\Post $post
 * @var array $products
 */

$this->title = 'Редактирование поста';
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->title];

?>

<?php $this->beginContent('@app/modules/post/views/backend/layout.php', compact('post')) ?>

    <?= $this->render('_form', compact('post', 'products')) ?>

<?php $this->endContent() ?>