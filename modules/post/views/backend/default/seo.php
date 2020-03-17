<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\post\models\Post $post
 */

$this->title = 'SEO';
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->title, 'url' => ['backend/default/update', 'id' => $post->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/post/views/backend/layout.php', compact('post')) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="box-body">
        <?= $form->field($post, 'h1') ?>
        <?= $form->field($post, 'meta_t') ?>
        <?= $form->field($post, 'meta_d')->textarea(['rows' => 5]) ?>
        <?= $form->field($post, 'meta_k')->hint('Фразы через запятую') ?>
    </div>
    <div class="box-footer with-border">
        <button class="btn btn-success">Сохранить</button>
    </div>

<?php ActiveForm::end() ?>
<?php $this->endContent() ?>
