<?php

namespace app\modules\admin\traits;

use yii\web\NotFoundHttpException;

trait QueryExceptions
{
    public static function getOrFail($condition): self
    {
        $model = self::findOne($condition);

        if (null == $model) {
            throw new NotFoundHttpException('Model not found');
        }

        return $model;
    }
}