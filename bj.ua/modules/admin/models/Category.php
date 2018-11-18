<?php

namespace app\modules\admin\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $descr
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function getArticle(){
        return $this->hasMany(Article::className(),['category_id'=>'id']);
    }
    public function rules()
    {
        return [
            [['name', 'descr'], 'required'],
            [['descr'], 'string'],
            [['name'], 'string', 'max' => 100],
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
