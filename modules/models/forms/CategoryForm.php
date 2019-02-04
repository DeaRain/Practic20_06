<?php

namespace app\modules\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class CategoryForm extends Model
{
    public $imageFile;
    public $name;
    public $descr;

    public function rules()
    {
        return [
            [['name','descr'], 'required'],
            [['descr'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'descr' => 'Описание',
            'imageFile' => 'Главная картинка',
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            return true;
        }
        return false;
    }
}
