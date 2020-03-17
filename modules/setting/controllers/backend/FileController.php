<?php

namespace app\modules\setting\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\setting\types\FileSetting;
use Yii;
use yii\web\Response;

class FileController extends BalletController
{
    public function actionDeleteFile($id)
    {
        $fileSetting = FileSetting::getOrFail($id);
        $fileSetting->deleteFile();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['message' => 'success'];
    }
}