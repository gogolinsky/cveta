<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\cert\models\Cert $cert
*/

$this->title = 'Добавление сертификата';
$this->params['breadcrumbs'][] = ['label' => 'Сертификаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="nav-tabs-custom">
    <?= $this->render('_form', compact('cert')) ?>
</div>