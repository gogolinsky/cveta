<?php

/**
 * @var \yii\web\View $this
 * @var array $phones
 */

?>

<?= implode(' &nbsp;|&nbsp; ', array_map(function($phone) {
	$clearPhone = preg_replace('#\D#', '', $phone);
	return "<a href='tel:$clearPhone'>$phone</a>";
}, $phones)) ?>