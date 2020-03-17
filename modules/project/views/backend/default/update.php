<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\project\models\Project $project
 * @var array $products
 */

$this->title = 'Редактирование проекта';
$this->params['breadcrumbs'][] = ['label' => 'Портфолио', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $project->title];

?>

<?php $this->beginContent('@app/modules/project/views/backend/layout.php', compact('project')) ?>

    <?= $this->render('_form', compact('project', 'products', 'employees')) ?>

<?php $this->endContent() ?>