<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $descr
 * @property string $photo
 * @property Article[] $articles
 */
class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    public static function getCategoryes()
    {
        return self::find()->all();
    }

    public static function findById($id){
        return self::find()->where(['id'=>$id])->limit(1)->one();
    }

    public static function getActiveArticleQuery(){
        return Article::find()->one();
    }

    public function getPhotoPath(){
        return Yii::$app->photoStorage->getImagePath($this->photo, getenv('CATEGORY_LOCATION_PATH'));
    }

    public static function create($name, $descr, $photo)
    {
        $category = new static();
        $category->name = $name;
        $category->descr = $descr;
        $category->photo = $photo;
        return $category;
    }
}
