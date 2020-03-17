<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\promo\models\Promo $promo
 */

$this->title = 'Редактирование услуги';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $promo->getTitle()];

?>

<?php $this->beginContent('@app/modules/promo/views/backend/layout.php', compact('promo')) ?>

<?= $this->render('_form', compact('promo')) ?>

<?php $this->endContent() ?>