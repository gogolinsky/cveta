<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var \app\modules\category\models\Category $category
 */

$this->title = $category->getTitle();
$this->params['breadcrumbs'][] = [
    'label' => 'Категории',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $category->getTitle();

?>

<?php $this->beginContent('@app/modules/category/views/backend/update.php', compact('category')) ?>
<?php $form = ActiveForm::begin() ?>
    <div class="box-body">
        <?= $form->field($category, 'h1') ?>
        <?= $form->field($category, 'meta_t') ?>
        <?= $form->field($category, 'meta_d')->textarea(['rows' => 5]) ?>
        <?= $form->field($category, 'meta_k')->hint('Фразы через запятую') ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
<?php $form::end() ?>
<?php $this->endContent() ?>