<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\vendor\models\Vendor $vendor
 */

$this->title = 'Редактирование производителя';
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = $vendor->getTitle();

?>

<?php $this->beginContent('@app/modules/vendor/views/backend/layout.php', ['vendor' => $vendor]); ?>

    <?= $this->render('_form', compact('vendor')) ?>

<?php $this->endContent() ?>