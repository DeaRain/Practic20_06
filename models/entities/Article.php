<?php

namespace app\models\entities;

use Yii;

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

    public function getTextStatus()
    {
        if ($this->status) {
            return 'Активен';
        } else {
            return 'На модерации';
        }
    }

    public static function create($category_id, $name, $content, $author, $status, $photo)
    {
        $article = new static();
        $article->category_id = $category_id;
        $article->name = $name;
        $article->content = $content;
        $article->author = $author;
        $article->status = $status;
        $article->photo = $photo;
        return $article;
    }

    public function getAuthorEntity()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getPhotoPath(){
        return Yii::$app->photoStorage->getImagePath($this->photo, getenv('ARTICLE_LOCATION_PATH'));
    }

    public static function findById($id){
        return self::find()->where(['id'=>$id])->limit(1)->one();
    }
}
