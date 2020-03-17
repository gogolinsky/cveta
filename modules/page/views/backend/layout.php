<?php

use yii\bootstrap\Nav;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var string $content
 * @var \app\modules\page\models\Page $page
 * @var array $breadcrumps
 */

$this->title = $page->getTitle();
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];

if(Yii::$app->controller->action->id == 'update') {
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->params['breadcrumbs'][] = [
        'label' => $this->title,
        'url' => ['/page/backend/update', 'id' => $page->id]
    ];
}

if(!empty($breadcrumbs)) {
    foreach ($breadcrumbs as $breadcrumb) {
        $this->params['breadcrumbs'][] = $breadcrumb;
    }
}

?>


<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => array_filter([
            [
                'label' => 'Общее',
                'url' => ['/page/backend/default/update', 'id' => $page->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'SEO',
                'url' => ['/page/backend/default/seo', 'id' => $page->id],
                'active' => Yii::$app->controller->action->id == 'seo',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить страницу',
                        'url' => ['/page/backend/default/delete', 'id' => $page->id],
                        'linkOptions' => [
                            'class' => 'text-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы уверены?',
                        ],
                    ],
                ],
            ],
        ])
    ]) ?>

    <?= $content ?>

</div>