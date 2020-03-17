<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $user
 * @var app\modules\user\models\Profile $profile
 */

$this->title = 'Редактирование профиля пользователя ' . $user->email;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $user->email;

?>

<?php $this->beginContent('@app/modules/user/views/backend/update.php', ['user' => $user]) ?>

    <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?= $form->field($profile, 'name') ?>
            <?= $form->field($profile, 'last_name') ?>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>

    <?php ActiveForm::end() ?>

<?php $this->endContent() ?>
