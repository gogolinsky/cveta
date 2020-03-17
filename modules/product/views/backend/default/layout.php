<?php

use yii\bootstrap\Tabs;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var string $content
 * @var \app\modules\product\models\Product $product
 * @var array $breadcrumbs
 */

$this->title = $product->getTitle();
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];

if(Yii::$app->controller->action->id == 'update') {
    $this->params['breadcrumbs'][] = $product->getTitle();
} else {
    $this->params['breadcrumbs'][] = [
        'label' => $product->getTitle(),
        'url' => ['/product/backend/default/update', 'id' => $product->id],
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
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['/product/backend/default/update', 'id' => $product->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'Вариации',
                'url' => ['/product/backend/variation/index', 'id' => $product->id],
                'active' => Yii::$app->controller->id == 'backend/variation',
            ],
            [
                'label' => 'SEO',
                'url' => ['/product/backend/default/seo', 'id' => $product->id],
                'active' => Yii::$app->controller->action->id == 'seo',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить товар',
                        'url' => Url::to(['/product/backend/default/delete', 'id' => $product->id]),
                        'linkOptions' => [
                            'class' => 'text-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы уверены?',
                        ],
                    ],
                ],
            ],
        ]
    ]) ?>

    <?= $content ?>

</div>