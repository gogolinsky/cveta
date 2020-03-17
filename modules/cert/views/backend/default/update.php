<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\cert\models\Cert $cert
 */

$this->title = 'Редактирование сертификата';
$this->params['breadcrumbs'][] = ['label' => 'Сертификаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $cert->title];

?>

<?php $this->beginContent('@app/modules/cert/views/backend/layout.php', compact('cert')) ?>

    <?= $this->render('_form', compact('cert')) ?>

<?php $this->endContent() ?>