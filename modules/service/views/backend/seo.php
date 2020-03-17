<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\service\models\Service $service
 */

$this->title = 'SEO';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $service->getTitle(), 'url' => ['update', 'id' => $service->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/service/views/backend/layout.php', compact('service')) ?>
    <?php $form = ActiveForm::begin() ?>

        <div class="box-body">
            <?= $form->field($service, 'h1') ?>
            <?= $form->field($service, 'meta_t') ?>
            <?= $form->field($service, 'meta_d')->textarea(['rows' => 5]) ?>
            <?= $form->field($service, 'meta_k')->hint('Фразы через запятую') ?>
        </div>

        <div class="box-footer with-border">
            <button class="btn btn-success">Сохранить</button>
        </div>

    <?php ActiveForm::end() ?>
<?php $this->endContent() ?>
