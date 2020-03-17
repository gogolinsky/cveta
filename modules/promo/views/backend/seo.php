<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\promo\models\Promo $promo
 */

$this->title = 'SEO';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $promo->getTitle(), 'url' => ['update', 'id' => $promo->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/promo/views/backend/layout.php', compact('promo')) ?>
    <?php $form = ActiveForm::begin() ?>

        <div class="box-body">
            <?= $form->field($promo, 'h1') ?>
            <?= $form->field($promo, 'meta_t') ?>
            <?= $form->field($promo, 'meta_d')->textarea(['rows' => 5]) ?>
            <?= $form->field($promo, 'meta_k')->hint('Фразы через запятую') ?>
        </div>

        <div class="box-footer with-border">
            <button class="btn btn-success">Сохранить</button>
        </div>

    <?php ActiveForm::end() ?>
<?php $this->endContent() ?>
