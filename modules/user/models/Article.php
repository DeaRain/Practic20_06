<?php

namespace app\modules\user\models;

use app\modules\user\models\Category;
use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $content
 * @property string $author
 * @property string $createtime
 * @property string $updatetime
 * @property int $status
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;

    public static function tableName()
    {
        return 'article';
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'content'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['name', 'author'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'category_id' => 'Категория',
            'imageFile' => 'Главная картинка',
            'name' => 'Название',
            'content' => 'Содержание',
            'author' => 'Автор',
            'status' => 'Статус',
        ];
    }
}
