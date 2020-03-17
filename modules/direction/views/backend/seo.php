<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\direction\models\Direction $direction
 */

$this->title = 'SEO';
$this->params['breadcrumbs'][] = ['label' => 'Направления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $direction->getTitle(), 'url' => ['update', 'id' => $direction->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/direction/views/backend/layout.php', compact('direction')) ?>
    <?php $form = ActiveForm::begin() ?>

        <div class="box-body">
            <?= $form->field($direction, 'h1') ?>
            <?= $form->field($direction, 'meta_t') ?>
            <?= $form->field($direction, 'meta_d')->textarea(['rows' => 5]) ?>
            <?= $form->field($direction, 'meta_k')->hint('Фразы через запятую') ?>
        </div>

        <div class="box-footer with-border">
            <button class="btn btn-success">Сохранить</button>
        </div>

    <?php ActiveForm::end() ?>
<?php $this->endContent() ?>
