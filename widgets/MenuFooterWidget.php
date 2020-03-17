<?php

namespace app\widgets;

use yii\base\Widget;

class MenuFooterWidget extends Widget
{
    public function run()
    {
        $items = array_filter([
            [
                'label' => 'Каталог',
                'url' => ['/category/frontend/index'],
            ],
            [
                'label' => 'Подбор материала',
                'url' => ['/direction/frontend/index'],
            ],
            [
                'label' => 'Акции',
                'url' => ['/promo/frontend/index'],
            ],
            [
                'label' => 'Услуги',
                'url' => ['/service/frontend/index'],
            ],
            [
                'label' => 'Портфолио',
                'url' => ['/project/frontend/index'],
            ],
            [
                'label' => 'Блог',
                'url' => ['/post/frontend/index'],
            ],
            [
                'label' => 'О нас',
                'url' => ['/site/about'],
            ],
            [
                'label' => 'Контакты',
                'url' => ['/site/contact'],
            ]
        ]);

        return $this->render('menu_footer', compact('items'));
    }
}