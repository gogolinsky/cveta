<?php

/**
 * @var \yii\web\View $this
 * @var \app\modules\category\models\Category $category
 */

?>

<?php if (!empty($category)): ?>
    <a class="catalog__link" data-id=<?= $category->id ?> href="<?= $category->getHref() ?>">
        <h4 class="catalog__name"><?= $category->getTitle() ?></h4>
        <p class="catalog__sign"><?= $category->hint ?></p>
        <div class="catalog__img">
            <img src="<?= $category->getThumbFileUrl('image') ?>" alt="<?= $category->getTitle() ?>">
        </div>
    </a>
<?php endif ?>