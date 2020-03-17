<?php

namespace app\widgets;

use app\modules\category\models\Category;
use app\modules\direction\models\Direction;
use app\modules\promo\models\Promo;
use app\modules\service\models\Service;
use yii\base\Widget;

class NavWidget extends Widget
{
    public function run()
    {
        $promoCount = Promo::find()->count();
        $items = array_filter([
            [
                'label' => 'Каталог' . '<img class="is-drop" src="/img/arrow-dropmenu.svg" alt="">',
                'url' => ['/category/frontend/index'],
                'template' => '<a class="nav__link" href={url} data-toggle="dropdown">{label}</a>',
                'submenuTemplate' => "<div class='nav__dropmenu'>
                                        <div class='dropmenu'>
                                            <ul class='dropmenu__list'>{items}</ul>
                                        </div>
                                    </div>",
                'items' => $this->getCatalog(),
            ],
            [
                'label' => 'Подбор материала' . '<img class="is-drop" src="/img/arrow-dropmenu.svg" alt="">',
                'url' => ['/direction/frontend/index'],
                'template' => '<a class="nav__link" href={url} data-toggle="dropdown">{label}</a>',
                'submenuTemplate' => "<div class='nav__dropmenu'>
                                        <div class='dropmenu'>
                                            <ul class='dropmenu__list'>{items}</ul>
                                        </div>
                                    </div>",
                'items' => $this->getDirections(),
            ],
            [
                'label' => 'Услуги' . '<img class="is-drop" src="/img/arrow-dropmenu.svg" alt="">',
                'url' => ['/service/frontend/index'],
                'template' => '<a class="nav__link" href={url} data-toggle="dropdown">{label}</a>',
                'submenuTemplate' => "<div class='nav__dropmenu'>
                                        <div class='dropmenu'>
                                            <ul class='dropmenu__list'>{items}</ul>
                                        </div>
                                    </div>",
                'items' => $this->getServices(),
            ],
            [
                'label' => 'Акции',
                'url' => ['/promo/frontend/index'],
                'template' => "<a class='nav__link' href={url} data-amount='$promoCount''>{label}</a>",
            ],
            [
                'label' => 'О нас',
                'url' => ['/about'],
            ],
            [
                'label' => 'Портфолио',
                'url' => ['/project/frontend/index'],
            ],
            [
                'label' => 'Блог',
                'url' => ['/blog'],
            ],
            [
                'label' => 'Контакты',
                'url' => ['/site/contact'],
            ] 
        ]);

        return $this->render('nav', compact('items'));
    }

    private function getCatalog()
    {
        return array_map(function(Category $category) {
            $arrow = $category->children(1)->exists() ? '<img class="is-second" src="/img/arrow-dropmenu.svg" alt="">' : '';
            return [
                'label' => $category->getTitle(),
                'url' => $category->getHref(),
                'options' => ['class' => 'dropmenu__item'],
                'template' => "<a class='dropmenu__link' href='{url}'>{label}{$arrow}</a>",
                'submenuTemplate' => "<div class='dropmenu__second'>
                                        <div class='dropmenu'>
                                            <ul class='dropmenu__list'>{items}</ul>
                                        </div>
                                    </div>",
                'items' => $this->getChildren($category),
            ];
        }, Category::find()->andWhere(['depth' => 1])->orderBy(['lft' => SORT_ASC])->all());
    }

    private function getChildren(Category $category)
    {
        return array_map(function(Category $category) {
            return [
                'label' => $category->getTitle(),
                'url' => $category->getHref(),
                'options' => ['class' => 'dropmenu__item'],
                'template' => '<a class="dropmenu__link" href="{url}">{label}</a>',
            ];
        }, $category->children(1)->orderBy(['lft' => SORT_ASC])->all());
    }

    private function getServices()
    {
        return array_map(function(Service $service) {
            return [
                'label' => $service->getTitle(),
                'url' => $service->getHref(),
                'options' => ['class' => 'dropmenu__item'],
                'template' => "<a class='dropmenu__link' href='{url}'>{label}</a>",
            ];
        }, Service::find()->orderBy(['position' => SORT_ASC])->all());
    }

    private function getDirections()
    {
        return array_map(function(Direction $direction) {
            return [
                'label' => $direction->getTitle(),
                'url' => $direction->getHref(),
                'options' => ['class' => 'dropmenu__item'],
                'template' => "<a class='dropmenu__link' href='{url}'>{label}</a>",
            ];
        }, Direction::find()->orderBy(['position' => SORT_ASC])->all());
    }
}