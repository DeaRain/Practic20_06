<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use Yii;

class PhotoStorage extends Component
{
    const LOCATION_PATH = "uploads/articlePhotos/";

    public function getImagePath($save_Name)
    {
        $name = substr_replace($save_Name, '/', 4, 0);
        $name = substr_replace($name, '/', 2, 0);
        return '/web/'.self::LOCATION_PATH.$name;
    }

    public function saveImage($image)
    {
        $name = sha1_file($image->tempName);
        $fileName = substr_replace($name, '/', 4, 0);
        $fileName = substr_replace($fileName, '/', 2, 0);
        FileHelper::createDirectory(self::LOCATION_PATH.substr($fileName, 0,5));
        $image->saveAs(self::LOCATION_PATH.$fileName.'.'.$image->extension);
        return $name.'.'.$image->extension;
    }

}