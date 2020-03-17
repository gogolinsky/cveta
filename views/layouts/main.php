<?php

use app\modules\feedback\widgets\CallbackFormWidget;
use app\modules\feedback\widgets\OrderFormWidget;
use app\modules\page\components\Pages;
use app\modules\setting\components\Settings;
use app\widgets\MenuFooterWidget;
use app\widgets\NavWidget;
use app\widgets\PhonesWidget;
use app\widgets\SocialWidget;
use yii\helpers\Html;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */

AppAsset::register($this);
$policy = Pages::getPage('privacy');

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html class="html" lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta property="og:type" content="website">
        <meta property="og:image" content="/img/share.png">
        <meta property="og:description" content="">
        <meta property="og:site_name" content="Мастер цвета">
        <meta property="og:locale" content="ru_RU">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;amp;subset=cyrillic">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <?= Settings::getRealValue('meta_tags') ?>
        <?php $this->head() ?>
    </head>
    <body class="body js-body">
    <script>document.querySelector('.js-body').classList.add('js-init');</script>

    <?php $this->beginBody() ?>
    <div class="page js-page" id="page">
        <header class="page__header">
            <div class="header">
                <div class="container">
                    <div class="header__inner">
                        <div class="header__logo">
                            <?php if (Yii::$app->request->url == '/'): ?>
                                <div class="logo">
                                    <p class="logo__name">Мастерская Цвета</p>
                                    <span class="logo__caption">студия красок</span>
                                </div>
                            <?php else: ?>
                                <a href="/" class="logo">
                                    <p class="logo__name">Мастерская Цвета</p>
                                    <span class="logo__caption">студия красок</span>
                                </a>
                            <?php endif ?>
                        </div>
                        <div class="header__nav">
                            <div class="header__top">
                                <ul class="contacts">
                                    <li class="contacts__item is-opacity">
                                        <img class="contacts__img is-clock" src="/img/clock.svg" alt="">
                                        <p class="contacts__caption">Мы открыты</p>
                                    </li>
                                    <li class="contacts__item">
                                        <img class="contacts__img is-place" src="/img/place.svg" alt="">
                                        <p class="contacts__caption"><?= Settings::getRealValue('address') ?></p>
                                    </li>
                                    <li class="contacts__item">
                                        <img class="contacts__img is-phone" src="/img/phone.svg" alt="">
                                        <p class="contacts__caption"><?= PhonesWidget::widget() ?></p>
                                    </li>
                                </ul>
                                <div class="header__button">
                                    <button class="button js-button is-callback" area-label="Заказать звонок" data-modal="callback">Заказать звонок</button>
                                </div>
                            </div>
                            <div class="header__bottom">

                                <?= NavWidget::widget() ?>

                                <div class="header__social">
                                    <?= SocialWidget::widget() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="page__content">
            <?= $content ?>
        </main>
        <footer class="page__footer">
            <div class="footer">
                <div class="container">
                    <div class="footer__top">
                        <div class="footer__contacts">
                            <div class="footer__logo">
                                <p class="logo__name">Мастерская Цвета</p>
                                <span class="logo__caption">студия красок</span>
                            </div>
                            <div class="footer__contact">
                                <ul class="contacts is-footer">
                                    <li class="contacts__item">
	                                    <img class="contacts__img is-clock" src="/img/clock.svg" alt="">
                                        <p class="contacts__caption">Мы открыты</p>
                                    </li>
                                    <li class="contacts__item">
	                                    <img class="contacts__img is-place" src="/img/place.svg" alt="">
                                        <p class="contacts__caption"><?= Settings::getRealValue('address') ?></p>
                                    </li>
                                    <li class="contacts__item">
	                                    <img class="contacts__img is-phone" src="/img/phone.svg" alt="">
                                        <p class="contacts__caption"><?= PhonesWidget::widget() ?></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer__social">
                                <?= SocialWidget::widget(['htmlClass' => 'is-footer']) ?>
                            </div>
                        </div>
                        <div class="footer__menu">
                            <?= MenuFooterWidget::widget() ?>
                        </div>
                    </div>
                    <div class="footer__bottom">
                        <div class="footer_c">
                            <p class="footer__copy"><?= Settings::getRealValue('copyright') ?></p>
                            <a class="footer__policy" href="<?= $policy->getHref() ?>">Политика конфиденциальности</a>
                        </div>
                        <div class="footer__dc">
                            <a class="dc" href="//dancecolor.ru" target="_blank">
                                <img class="dc__img" src="/img/dc-logo.svg" alt="Dancecolor логотип">
                                <div class="dc_naming">
                                    <p class="dc__caption">cделано для продвижения</p>
                                    <p class="dc__name">DANCECOLOR</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="modal js-modal">
            <div class="modal__template js-modal-template">
                <div class="modal__inner js-modal-inner">
                    <button class="modal__close" data-modal-close title="Закрыть"></button>
                    <div class="modal__header js-modal-header"></div>
                    <div class="modal__content js-modal-content"></div>
                </div>
            </div>
        </div>
        <div class="modal__cols">
            <div id="modal-callback">
                <div class="modal__col">
                    <div class="modal__background">
                        <div class="modal__img"><img src="/img/table.png" alt=""></div>
                    </div>
                </div>
                <div class="modal__form">
                    <?= CallbackFormWidget::widget() ?>
                </div>
            </div>
            <?php if (isset($this->params['product'])): ?>
                <div id="modal-order">
                    <div class="modal__col">
                        <div class="modal__background">
                            <div class="modal__img">
                                <img src="/img/table.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="modal__form">
                        <?= OrderFormWidget::widget(['product' => $this->params['product']]) ?>
                    </div>
                </div>
            <?php endif ?>
            <div id="modal-employee"></div>
            <div id="modal-colorPicker">
                <div class="container">
                    <div class="color-picker js-color-picker">
                        <div class="color-picker__header">
                            <h3 class="color-picker__title">Выбор цвета</h3>
                            <p class="color-picker__subtitle">Выберите необходимый оттенок.</p>
                        </div>
                        <div class="color-picker__body">
                            <ul class="color-picker__list">
                                <li class="color-picker__item js-color-picker-item" style="background-color: #e5e8f0;" data-color="#e5e8f0"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #f15a24;" data-color="#f15a24"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #f7931e;" data-color="#f7931e"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #d4e6b6;" data-color="#d4e6b6"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #ffff00;" data-color="#ffff00"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #d9e021;" data-color="#d9e021"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #0c9856;" data-color="#0c9856"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #29abe2;" data-color="#29abe2"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #3838e2;" data-color="#3838e2"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #662d91;" data-color="#662d91"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #ed1e79;" data-color="#ed1e79"></li>
                                <li class="color-picker__item js-color-picker-item" style="background-color: #de2828;" data-color="#de2828"></li>
                            </ul>
                            <p class="color-picker__description">Обращаем ваше внимание, что цвета на вашем дисплее скорее всего не будут соответствовать действительности. Для точной колеровки приглашаем вас в гости в нашу студию.</p>
                            <ul class="color-picker__list js-color-picker-list is-color">
                               
                            </ul>
                        </div>
                        <div class="color-picker__footer">
                            <a class="button is-bordered" area-label="←&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;Назад в портфолио" data-modal-close>←&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Назад в портфолио</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= Settings::getRealValue('metrika_code') ?>
    <?= Settings::getRealValue('analitics_code') ?>
    <?= Settings::getRealValue('callback_code') ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>