<?php

use app\helpers\DateHelper;
use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\helpers\Badge;
use app\modules\feedback\helpers\StatusHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\models\Feedback[] $feedbacks
 */

 ?>

<?php Pjax::begin(['options' => ['id' => 'pjax-widget']]); ?>
<div class="box box-primary">
    <div class="box-header with-border" data-widget="collapse">
        <h3 class="box-title">Заявки </h3>
        <div class="box-tools pull-right">
            <?php if (!empty(Badge::getSum())): ?>
                <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="<?= Badge::getSum() ?> Новых заявок"><?= Badge::getSum() ?></span>
            <?php endif ?>

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

        </div>

    </div>
    <div class="box-body">

        <ul class="products-list product-list-in-box">
            <?php foreach ($feedbacks as $feedback): ?>
                <li class="item">
                    <div>
                        <span href="<?= Url::to(['/feedback/backend/default/view', 'id' => $feedback->id]) ?>" class="product-title" data-toggle="modal" data-target="#modal-lg"><?= $feedback::TITLE ?></span>
                        <span class="label label-<?= StatusHelper::getStatusClass($feedback->status)?> pull-right"><?= StatusHelper::getStatusText($feedback->status)?></span>
                        <span class="product-description">
                          <?= DateHelper::forHuman($feedback->created_at, 'd n Y H:i') ?>
                        </span>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>

    </div>
    <div class="box-footer text-center">
        <a href="<?= Url::to(['/feedback/backend/default/index', 'type' => CallbackForm::TYPE]) ?>" class="uppercase" data-pjax="0">Посмотреть все заявки</a>
    </div>
</div>
<?php Pjax::end(); ?>