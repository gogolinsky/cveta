<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\service\models\Service $service
 */

$this->title = 'Редактирование услуги';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $service->getTitle()];

?>

<?php $this->beginContent('@app/modules/service/views/backend/layout.php', compact('service')) ?>

<?= $this->render('_form', compact('service')) ?>

<?php $this->endContent() ?>