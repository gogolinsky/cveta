<?php

use yii\mail\BaseMessage;

/**
 * @var \yii\web\View $this
 * @var BaseMessage $content
 */

?>

<?php $this->beginPage(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Заказ на сайте</title>
    </head>

    <body>
        <?php $this->beginBody() ?>
            <?= $content ?>
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage(); ?>
