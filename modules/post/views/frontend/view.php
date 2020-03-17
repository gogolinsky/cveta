<?php

use app\modules\product\widgets\ProductWidget;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var \app\modules\post\models\Post $post
 * @var \app\modules\product\models\Product[] $products
 * @var \app\modules\employee\models\Employee[] $employees
 * @var \app\modules\post\models\PostImage[] $images
 */

$post->generateMetaTags();
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index'], 'class' => 'breadcrumb__link'];

?>

<div class="headline is-small">
    <div class="headline__cover is-small">
        <div class="container">
            <div class="headline__breadcrumb">
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
            <h1 class="headline__title"><?= $post->getH1() ?></h1>
        </div>
    </div>
    <div class="headline__case">
        <img src="<?= $post->getThumbFileUrl('image', 'origin') ?>" alt="<?= $post->getTitle() ?>">
    </div>
</div>

<section class="section is-m-60">
    <div class="container">
        <div class="section__body">
            <?php if ($post->content): ?>
                <div class="text is-post">
                    <?= $post->content ?>
                </div>
            <?php endif ?>
            <?php if (!empty($images)): ?>
                <div class="post__gallery grid is-row">
                    <?php foreach ($images as $image): ?>
                        <img class="col-6" src="<?= $image->getThumbFileUrl('image') ?>" alt="">
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>

<?php if (!empty($products)): ?>
    <section class="section is-left ">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title">В статье были описаны</h2>
            </header>
            <div class="section__body">
                <div class="products__loader js-products-loader"><img src="img/loader.gif" alt=""></div>
                <div class="products js-products">
                    <ul class="products__list grid is-row">
                        <?php foreach ($products as $product): ?>
                            <li class="products__item col-3">
                                <?= ProductWidget::widget(compact('product')) ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<section class="section is-margin-0">
    <div class="container">
        <div class="section__body">
            <div class="jump">
                <div class="jump__centered">
                    <a href="<?= Url::to(['index']) ?>" class="button js-button is-bordered" area-label="←&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;Назад в портфолио">←&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Назад в портфолио</a>
                </div>
            </div>
        </div>
    </div>
</section>