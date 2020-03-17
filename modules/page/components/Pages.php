<?php

namespace app\modules\page\components;

use app\modules\page\models\Page;
use Yii;
use yii\helpers\ArrayHelper;

class Pages
{
    private static $pages = null;
    private static $currentPage = null;

    public static function getPages()
    {
        if (is_null(self::$pages)) {
            self::$pages = Page::find()->select([
                'id',
                'title',
                'lft',
                'rgt',
                'depth',
                'alias',
                'route',
                'parent_id',
            ])->orderBy('lft')->indexBy('id')->where(['>', 'depth', 0])->all();
        }

        return self::$pages;
    }

    public static function getPage($id): Page
    {
        $pages = self::getPages();

        return ArrayHelper::getValue($pages, $id, new Page());
    }

    public static function getHref($id)
    {
        return self::getPage($id)->getHref();
    }

    public static function getTitle($id)
    {
        return self::getPage($id)->getTitle();
    }

    public static function getCurrentPage() : Page
    {
        if (empty(self::$currentPage)) {
            $route = Yii::$app->controller->getRoute();

            if ('page/frontend/view' !== $route) {
                self::$currentPage = Page::findOne(['route' => '/' . $route]);
            }

            if (empty(self::$currentPage)) {
                self::$currentPage = new Page();
            }
        }

        return self::$currentPage;
    }

    public static function setCurrentPage(Page $page)
    {
        self::$currentPage = $page;
    }

    public static function getParentBreadcrumbs($pageId = null)
    {
        if (empty($pageId)) {
            $pageId = self::getCurrentPage()->parent_id;
        }

        if (!empty($pageId) && !in_array($pageId, ['root', 'index'])) {
            $parent = self::getPage($pageId);
            return array_merge(self::getParentBreadcrumbs($parent->parent_id), !empty($parent->title)? [[
                'label' => $parent->title,
                'url' => $parent->getHref(),
                'class' => 'breadcrumb__link',
            ]]: []);
        }

        return [
            [
                'label' => 'Главная',
                'title' => 'Главная',
                'url' => ['/site/index'],
                'class' => 'breadcrumb__link',
            ]
        ];
    }

    public static function getBreadcrumbs()
    {
        $page = self::getCurrentPage();
        $breadcrumbs = self::getParentBreadcrumbs($page->parent_id);
        $breadcrumbs[] = $page->getTitle();

        return $breadcrumbs;
    }

    public static function getElementValue($key)
    {
        $elements = self::getCurrentPage()->elements;

        if(!empty($elements) && !empty($elements[$key])) {
            return $elements[$key]->value ?? '';
        }

        return '';
    }
}