<?php

namespace app\helpers;

class FileHelper extends \yii\helpers\FileHelper
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
}