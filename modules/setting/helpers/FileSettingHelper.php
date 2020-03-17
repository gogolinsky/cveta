<?php

namespace app\modules\setting\helpers;

use yii\helpers\FileHelper;

class FileSettingHelper
{
    public static function getType($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'jpg':
            case 'png':
            case 'jpeg':
            case 'gif': return 'image';
            case 'pdf': return 'pdf';
            case 'mp4': return 'video';
            default: return 'other';
        }
    }

    public static function getFileType($filename)
    {
        return FileHelper::getMimeTypeByExtension($filename);
    }
}