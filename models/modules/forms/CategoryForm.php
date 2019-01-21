<?php

namespace app\models\modules\forms;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $descr
 *
 * @property Article[] $articles
 */
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
            [['name'], 'required'],
            [['descr'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
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
