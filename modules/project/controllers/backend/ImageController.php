<?php

namespace app\modules\project\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\project\models\Project;
use app\modules\project\models\ProjectImage;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class ImageController extends BalletController
{
    public function actionUpload($id)
    {
        $project = Project::getOrFail($id);
        $files = UploadedFile::getInstances($project, 'images');

        foreach ($files as $file) {
            $image = new ProjectImage([
                'project_id' => $project->id,
                'image' => $file,
            ]);
            $image->save();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionDelete()
    {
        $image = ProjectImage::getOrFail(Yii::$app->request->post('key'));
        $image->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }

    public function actionSort()
    {
        $image = ProjectImage::getOrFail(Yii::$app->request->post('key'));
        $image->position = Yii::$app->request->post('position');
        $image->save();
    }
}