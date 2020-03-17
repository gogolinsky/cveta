<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\direction\models\Direction $direction
 */

$this->title = 'Редактирование направления';
$this->params['breadcrumbs'][] = ['label' => 'Направления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $direction->getTitle()];

?>

<?php $this->beginContent('@app/modules/direction/views/backend/layout.php', compact('direction')) ?>

<?= $this->render('_form', compact('direction')) ?>

<?php $this->endContent() ?>