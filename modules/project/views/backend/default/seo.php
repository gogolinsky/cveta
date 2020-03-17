<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\project\models\Project $project
 */

$this->title = 'SEO';
$this->params['breadcrumbs'][] = ['label' => 'Портфолио', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['backend/default/update', 'id' => $project->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/project/views/backend/layout.php', compact('project')) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="box-body">
        <?= $form->field($project, 'h1') ?>
        <?= $form->field($project, 'meta_t') ?>
        <?= $form->field($project, 'meta_d')->textarea(['rows' => 5]) ?>
        <?= $form->field($project, 'meta_k')->hint('Фразы через запятую') ?>
    </div>
    <div class="box-footer with-border">
        <button class="btn btn-success">Сохранить</button>
    </div>

<?php ActiveForm::end() ?>
<?php $this->endContent() ?>
