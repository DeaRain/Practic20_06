<?php

namespace app\modules\models\forms;

use yii\base\Model;

class CategoryForm extends Model
{
    public $imageFile;
    public $id;
    public $name;
    public $descr;
    public $photo;
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
            'id' => 'ID',
            'name' => 'Название',
            'descr' => 'Описание',
            'imageFile' => 'Главная картинка',
        ];
    }
}
