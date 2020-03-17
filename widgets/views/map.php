<?php

use app\modules\setting\components\Settings;
use app\widgets\PhonesWidget;
use app\widgets\SocialWidget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * @var \yii\web\View $this
 * @var array $dataMap
 */

?>

<section class="section is-blue is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="map js-map" data-options="<?= Html::encode(Json::encode($dataMap)) ?>">
                <div class="map__container js-map-container"></div>
                <div class="map__block">
                    <div class="map__info">
                        <div class="map__headline">Наши контакты</div>
                        <div class="map__contacts">
                            <ul class="contacts is-footer">
                                <li class="contacts__item">
                                    <img class="contacts__img is-clock" src="/img/yellow-time.svg" alt="">
                                    <p class="contacts__caption">Мы открыты</p>
                                </li>
                                <li class="contacts__item">
                                    <img class="contacts__img is-phone" src="/img/yellow-phone.svg" alt="">
                                    <p class="contacts__caption"><?= PhonesWidget::widget() ?></p>
                                </li>
                                <li class="contacts__item">
                                    <img class="contacts__img is-place" src="/img/yellow-place.svg" alt="">
                                    <p class="contacts__caption"><?= Settings::getRealValue('address') ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="map__social">
                        <?= SocialWidget::widget(['htmlClass' => 'is-footer']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>