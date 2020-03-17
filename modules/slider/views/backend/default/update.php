<?php

/**
 * @var yii\web\View $this
 * @var \app\modules\slider\models\Slide $slider
 */

$this->title = 'Редактирование слайда';
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $slider->title];

?>

<?php $this->beginContent('@app/modules/slider/views/backend/layout.php', compact('slider')) ?>

    <?= $this->render('_form', compact('slider')) ?>

<?php $this->endContent() ?>