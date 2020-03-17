<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\partner\models\Partner $partner
 */

$this->title = 'Редактирование партнера';
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $partner->title];

?>

<?php $this->beginContent('@app/modules/partner/views/backend/layout.php', compact('partner')) ?>

    <?= $this->render('_form', compact('partner')) ?>

<?php $this->endContent() ?>