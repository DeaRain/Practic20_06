<?php
namespace app\modules\models\forms;

use yii\base\Model;
use app\models\entities\User;
use app\models\entities\Category;

class ArticleForm extends Model
{
    public $id;
    public $category_id;
    public $name;
    public $content;
    public $author;
    public $status;
    public $photo;
    public $imageFile;
    public $category;

    public function rules()
    {
        return [
            [['category_id', 'author', 'status'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
            [['photo'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'category_id' => 'Категория',
            'imageFile' => 'Главная картинка',
            'name' => 'Название',
            'content' => 'Содержание',
            'author' => 'Автор',
            'photo' => 'Главное фото',
            'status' => 'Статус',
        ];
    }
}
