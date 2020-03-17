<?php

use app\modules\feedback\widgets\HelpFormWidget;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var \app\modules\promo\models\Promo $promo
 */

$promo->generateMetaTags();
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['index'], 'class' => 'breadcrumb__link'];
$this->params['h1'] = $promo->getH1();

?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="promo">
                <div class="promo__img">
                    <img src="<?= $promo->getThumbFileUrl('image', 'view') ?>" alt="<?= $promo->getTitle() ?>">
                </div>
                <div class="promo__description">
                    <div class="promo__title">
                        <div class="promo__breadcrumb">
                            <?= Breadcrumbs::widget([
                                'itemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                                'activeItemTemplate' => "<li class='breadcrumb__item'>{link}</li>",
                                'options' => ['class' => 'breadcrumb'],
                                'homeLink' =>  [
                                    'label' => 'Главная',
                                    'title' => 'Главная',
                                    'url' => ['/site/index'],
                                    'class' => 'breadcrumb__link',
                                ],
                                'links' => $this->params['breadcrumbs'] ?? [],
                            ]) ?>
                        </div>
                        <h3 class="promo__name"><?= $promo->getTitle() ?></h3>
                        <div class="promo__caption"><?= $promo->content ?></div>
                    </div>
                    <div class="promo__button">
                        <a href="<?= Url::to(['index']) ?>" class="button js-button is-bordered is-promo" area-label="←&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;Вернуться к акциям">←&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Вернуться к акциям</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= HelpFormWidget::widget() ?>
