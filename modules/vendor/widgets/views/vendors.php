<?php

use app\modules\vendor\widgets\VendorWidget;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \app\modules\vendor\models\Vendor[] $vendors
 * @var boolean $showButtonToVendors
 * @var boolean $showText
 * @var string $sectionClass
 */

?>

<?php if (!empty($vendors)): ?>
    <section class="section <?= $sectionClass ?>">
        <div class="container">
	        <?php if ($showText): ?>
		        <header class="section__header">
			        <h2 class="section__title">Производители</h2>
			        <p class="section__caption">
				        Мы работаем исключительно с хорошо зарекомендовавшими себя производителями,
				        ориентируясь на качество и позитивные отзывы наших клиентов.
			        </p>
		        </header>
	        <?php endif ?>
            <div class="section__body">
                <ul class="vendors">
                    <?php foreach ($vendors as $vendor): ?>
                        <li class="vendors__item">
                            <?= VendorWidget::widget(compact('vendor')) ?>
                        </li>
                    <?php endforeach ?>
                </ul>
	            <?php if ($showButtonToVendors): ?>
		            <div class="vendors__button">
			            <a class="button js-button is-bordered" area-label="Выбрать по производителю" href="<?= Url::to(['/vendor/frontend/index']) ?>">Выбрать по производителю</a>
		            </div>
	            <?php endif ?>
            </div>
        </div>
    </section>
<?php endif ?>
