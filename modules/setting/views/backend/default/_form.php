<?php

use app\modules\setting\helpers\SettingHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;

/**
 * @var \yii\web\View $this
 * @var \app\modules\setting\models\Setting $setting
 */

if (!$isAjax = Yii::$app->request->isAjax) {
    $this->params['breadcrumbs'] = [
        [
            'label' => 'Настройки',
            'url' => ['/setting/backend/default/index'],
        ],
        $this->title,
    ];
}

?>

<?php $form = ActiveForm::begin($isAjax? ['id' => 'js-modal-form'] : []) ?>
<div class="modal-body">
    <?php if (YII_ENV_DEV): ?>
        <?= Collapse::widget([
            'items' => [
                [
                    'label' => 'Дополнительно',
                    'content' => $form->field($setting, 'id')->input('text', ['disabled' => !$setting->isNewRecord])
                        . $form->field($setting, 'title')
                        . $form->field($setting, 'description')->textarea()
                        . $form->field($setting, 'hint')->textarea(),
                ],
            ]
        ]) ?>
    <?php endif ?>
    <?php if ($setting->isNewRecord): ?>
        <?= $form->field($setting, 'type')->dropDownList(SettingHelper::getTypesDropDown()) ?>
    <?php else: ?>
        <?php if (!empty($setting->description)): ?>
            <div class="well">
                <?= $setting->description ?>
            </div>
        <?php endif ?>
        <?= $setting->formField($form); ?>
    <?php endif ?>
</div>
<div class="modal-footer">
    <button class="btn btn-success">Сохранить</button>
    <?php if ($isAjax): ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
    <?php endif ?>
</div>
<?php ActiveForm::end() ?>
