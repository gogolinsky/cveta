<?php

use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \app\modules\user\forms\PasswordForm $passwordForm
 * @var \app\modules\user\models\User $user
 */

$this->title = 'Смена пароля для ' . $user->email;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Смена пароля для ' . $user->email;

?>

<?php $this->beginContent('@app/modules/user/views/backend/update.php', ['user' => $user]) ?>
<?php $form = ActiveForm::begin() ?>
    <div class="box-body">
        <?= $form->field($passwordForm, 'password') ?>
        <?= $form->field($passwordForm, 'password_repeat') ?>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
<?php ActiveForm::end() ?>
<?php $this->endContent() ?>
