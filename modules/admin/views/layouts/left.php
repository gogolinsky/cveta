<?php

use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\helpers\Badge;
use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => 'Главная',
                        'icon' => 'home',
                        'url' => Yii::$app->getHomeUrl(),
                    ],
                    [
                        'label' => 'Страницы',
                        'icon' => 'files-o',
                        'url' => ['/page/backend/default/index'],
                        'active' => Yii::$app->controller->module->id == 'page',
                    ],
                    [
                        'label' => 'Каталог',
                        'icon' => 'folder-o',
                        'items' => [
                            [
                                'label' => 'Товары',
                                'icon' => 'shopping-cart',
                                'url' => ['/product/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'product',
                            ],
                            [
                                'label' => 'Категории',
                                'icon' => 'folder-open',
                                'url' => ['/category/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'category',
                            ],
                            [
                                'label' => 'Характеристики',
                                'icon' => 'list',
                                'url' => ['/eav/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'eav',
                            ],
                            [
                                'label' => 'Производители',
                                'icon' => 'tags',
                                'url' => ['/vendor/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'vendor',
                            ],
                            [
                                'label' => 'Направления',
                                'icon' => 'arrows-h',
                                'url' => ['/direction/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'direction',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'file-text',
                        'items' => [
                            [
                                'label' => 'Слайдер',
                                'icon' => 'image',
                                'url' => ['/slider/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'slider',
                            ],
                            [
                                'label' => 'Услуги',
                                'icon' => 'bookmark-o',
                                'url' => ['/service/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'service',
                            ],
                            [
                                'label' => 'Акции',
                                'icon' => 'star-o',
                                'url' => ['/promo/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'promo',
                            ],
                            [
                                'label' => 'Сотрудники',
                                'icon' => 'user-o',
                                'url' => ['/employee/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'employee',
                            ],
                            [
                                'label' => 'Портфолио',
                                'icon' => 'file-photo-o',
                                'url' => ['/project/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'project',
                            ],
                            [
                                'label' => 'Блог',
                                'icon' => 'pencil',
                                'url' => ['/post/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'post',
                            ],
                            [
                                'label' => 'Партнеры',
                                'icon' => 'male',
                                'url' => ['/partner/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'partner',
                            ],
                            [
                                'label' => 'Сертификаты',
                                'icon' => 'shield',
                                'url' => ['/cert/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'cert',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Заявки' . Badge::getSumBadge(),
                        'icon' => 'bell-o',
                        'url' => ['/feedback/backend/default/index', 'type' => CallbackForm::TYPE],
                        'active' => Yii::$app->controller->module->id == 'feedback',
                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'cogs',
                        'items' => [
                            [
                                'label' => 'Настройки',
                                'icon' => 'cog',
                                'url' => ['/setting/backend/default/index'],
                                'active' => Yii::$app->controller->module->id == 'setting',
                            ],
                            [
                                'label' => 'Пользователи',
                                'icon' => 'users',
                                'url' => ['/user/backend/index'],
                                'active' => Yii::$app->controller->module->id == 'user',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>
