<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\page\models\Page $page
 */

?>


<?php $this->beginContent('@app/modules/page/views/backend/layout.php', ['page' => $page, 'breadcrumbs' => ['SEO']]) ?>
<?php $form = ActiveForm::begin() ?>
    <div class="box-body">

        <?= $form->field($page, 'h1') ?>
        <?= $form->field($page, 'meta_t') ?>
        <?= $form->field($page, 'meta_d')->textarea(['rows' => 5]) ?>
        <?= $form->field($page, 'meta_k')->hint('Фразы через запятую') ?>
    </div>
    <div class="box-footer">
        <button class="btn btn-success">Сохранить</button>
    </div>

<?php ActiveForm::end() ?>
<?php $this->endContent() ?>
