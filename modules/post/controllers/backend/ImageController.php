<?php

namespace app\modules\post\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\post\models\Post;
use app\modules\post\models\PostImage;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class ImageController extends BalletController
{
    public function actionUpload($id)
    {
        $post = Post::getOrFail($id);
        $files = UploadedFile::getInstances($post, 'images');

        foreach ($files as $file) {
            $image = new PostImage([
                'post_id' => $post->id,
                'image' => $file,
            ]);
            $image->save();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionDelete()
    {
        $image = PostImage::getOrFail(Yii::$app->request->post('key'));
        $image->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionSort()
    {
        $image = PostImage::getOrFail(Yii::$app->request->post('key'));
        $image->position = Yii::$app->request->post('position');
        $image->save();
    }
}