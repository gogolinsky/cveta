<?php

/**
 * @var \yii\web\View $this
 * @var array $data
 */

?>
<?php if (!empty($data)): ?>
<table>
    <?php foreach ($data as $row): ?>
        <tr>
            <?php foreach ($row as $td): ?>
                <td style="padding: 0 3px; border: 1px solid #e1e1e1"><?= $td ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
</table>
<?php endif ?>