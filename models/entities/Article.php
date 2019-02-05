<?php

namespace app\models\entities;

use app\models\behaviors\PhotoStorage;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $content
 * @property int $author
 * @property int $status
 * @property string $photo
 * @property Category $category
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => PhotoStorage::className(),
                'path' => getenv('ARTICLE_LOCATION_PATH'),
                'defaultName' => 'default.jpg',
            ]
        ];
    }

    public function getTextStatus()
    {
        if ($this->status) {
            return 'Активен';
        } else {
            return 'На модерации';
        }
    }

    public static function create($category_id, $name, $content, $author, $status)
    {
        $article = new static();
        $article->category_id = $category_id;
        $article->name = $name;
        $article->content = $content;
        $article->author = $author;
        $article->status = $status;
        return $article;
    }

    public function edit($category_id, $name, $content, $author, $status)
    {
        $this->category_id = $category_id;
        $this->name = $name;
        $this->content = $content;
        $this->author = $author;
        $this->status = $status;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

}
