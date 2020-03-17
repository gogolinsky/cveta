<?php

use app\modules\page\components\Pages;
use app\widgets\MapWidget;

/**
 * @var yii\web\View $this
 */

Pages::getCurrentPage()->generateMetaTags();

?>

<?= MapWidget::widget() ?>