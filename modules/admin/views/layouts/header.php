<?php

use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Url::to(['/site/index']), ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu" style="padding: 0 15px;">

            <?php NavBar::begin([
                    'renderInnerContainer' => false,
            ]);
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::$app->user->identity->email,
                        'items' => [
                            [
                                'label' => Icon::show('power') . 'Выйти',
                                'url' => ['/user/security/logout'],
                                'linkOptions' => [
                                    'data-method' => 'post',
                                ],
                            ],
                        ],
                    ],
                ],
            ]);
            NavBar::end();?>
        </div>
    </nav>
</header>
