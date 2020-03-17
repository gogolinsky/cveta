<?php

use app\modules\product\helpers\ProductHelper;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var Product $product
 * @var array $directions
 */

[$dropDownArray, $dropDownOptionsArray] = ProductHelper::generateDropDownArrays();

?>

<?php $form = ActiveForm::begin() ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <?= $form->field($product, 'view')->dropDownList(ProductHelper::getProductViewList()) ?>
                <?= $form->field($product, 'title') ?>
                <?= $form->field($product, 'hint') ?>
                <?= $form->field($product, 'category_id')->dropDownList($dropDownArray, $dropDownOptionsArray) ?>
                <?= $form->field($product, 'code') ?>
                <?= $form->field($product, 'vendor_id')->dropDownList(ProductHelper::getVendorList(), ['prompt' => '']) ?>
                <?= $form->field($product, 'price') ?>
                <?= $form->field($product, 'consumption') ?>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="single-kartik-image">
                    <img src="<?= $product->image ?>" alt="">
                    <?= $form->field($product, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $product->getThumbFileUrl('image'),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' =>  'Выберите файл',
                            'deleteUrl' => Url::to(['/product/backend/default/delete-image', 'id' => $product->id]),
                            'initialPreview' => [
                                $product->hasImage() ? $product->getThumbFileUrl('image') : null,
                            ],
                            'initialPreviewConfig' => [
                                $product->hasImage() ? [
                                    'caption' => $product->image,
                                    'size' => filesize($product->getThumbFilePath('image')),
                                    'downloadUrl' => $product->getThumbFileUrl('image'),
                                ] : [],
                            ],
                            'initialPreviewAsData' => true,
                        ],
                    ]);?>
                </div>
            </div>
        </div>
        <?php if (!$product->isNewRecord): ?>
            <?= $form->field($product, 'images[]')->widget(FileInput::class, [
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/product/backend/image/upload', 'id' => $product->id]),
                    'deleteUrl' => Url::to(['/product/backend/image/delete']),
                    'initialPreview' => array_map(function(ProductImage $image){
                        return $image->getUploadedFileUrl('image');
                    }, $product->images),
                    'initialPreviewConfig' => array_map(function(ProductImage $image){
                        return [
                            'key' => $image->id,
                            'caption' => $image->image,
                            'size' => filesize($image->getUploadedFilePath('image')),
                            'downloadUrl' => $image->getUploadedFileUrl('image'),
                        ];
                    }, $product->images),
                    'initialPreviewAsData' => true,
                    'overwriteInitial' => false,
                    'showClose' => false,
                    'browseClass' => 'btn btn-primary text-right',
                    'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                    'browseLabel' =>  'Выберите файл',
                ],
                'pluginEvents' => [
                    'filesorted' => 'function(event, params) { 
                        $.post("' . Url::to(['/product/backend/image/sort']) . '",
                            { key : params.stack[params.newIndex].key, position : params.newIndex + 1 },
                        )
                    }',
                ],
                'options' => [
                    'multiple' => true,
                ],
            ]) ?>
            <?= $form->field($product, 'directionsIds')->widget(Select2::class, [
                'data' => $directions,
                'options' => ['placeholder' => '...', 'autocomplete' => 'off'],
                'showToggleAll' => false,
                'theme' => Select2::THEME_BOOTSTRAP,
                'pluginOptions' => ['multiple' => true, 'allowClear' => false],
            ]) ?>
            <?= $this->render('eav/attributes', compact('product')) ?>
            <?= $form->field($product, 'description')->widget(CKEditor::class) ?>

        <?php endif ?>

    </div>
    <div class="box-footer with-border">
        <button class="btn btn-success">Сохранить</button>
    </div>

<?php ActiveForm::end() ?>