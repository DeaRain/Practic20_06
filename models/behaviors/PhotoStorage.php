<?php

namespace app\models\behaviors;

use yii\base\Behavior;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class PhotoStorage extends Behavior
{
    public $path;
    public $defaultName;

    public function getPhoto()
    {
        $name = substr_replace($this->owner->photo, '/', 4, 0);
        $name = substr_replace($name, '/', 2, 0);
        return '/web/'. $this->path . $name;
    }

    public function setPhoto(UploadedFile $imageFile = null)
    {
        if ($imageFile) {
            $name = sha1_file($imageFile->tempName);
            $fileName = substr_replace($name, '/', 4, 0);
            $fileName = substr_replace($fileName, '/', 2, 0);
            FileHelper::createDirectory($this->path . substr($fileName, 0, 5));
            $imageFile->saveAs($this->path . $fileName . '.' . $imageFile->extension);
            $this->owner->photo = $name . '.' . $imageFile->extension;
            return true;
        } elseif ($this->owner->photo == null) {
            $this->owner->photo = $this->defaultName;
            return true;
        }
        return false;
    }
}