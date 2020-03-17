<?php

namespace app\modules\product\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class ImageController extends BalletController
{
    public function actionUpload($id)
    {
        $product = Product::getOrFail($id);
        $files = UploadedFile::getInstances($product, 'images');
        foreach ($files as $file) {
            $image = new ProductImage([
                'product_id' => $product->id,
                'image' => $file,
            ]);
            $image->save();
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionDelete()
    {
        $image = ProductImage::getOrFail(Yii::$app->request->post('key'));
        $image->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionSort()
    {
        $image = ProductImage::getOrFail(Yii::$app->request->post('key'));
        $image->position = Yii::$app->request->post('position');
        $image->save();
    }
}