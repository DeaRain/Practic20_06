<?php

namespace app\models\entities;

use app\models\behaviors\PhotoStorage;
use Yii;
use yii\web\UploadedFile;

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

    public function behaviors()
    {
        return [
            [
                'class' => PhotoStorage::className(),
                'path' => getenv('CATEGORY_LOCATION_PATH'),
                'defaultName' => 'default.jpg',
            ]
        ];
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

    public static function create($name, $descr)
    {
        $category = new static();
        $category->name = $name;
        $category->descr = $descr;
        $category->photo = getenv('CATEGORY_DEFAULT_PHOTO_NAME');

        return $category;
    }

    public function edit($name, $descr)
    {
        $this->name = $name;
        $this->descr = $descr;
    }

//    public function setPhoto(UploadedFile $imageFile = null)
//    {
//        if ($imageFile) {
//            $this->photo = Yii::$app->photoStorage->saveImage($imageFile, getenv('CATEGORY_LOCATION_PATH'));
//        } elseif ($this->photo == null) {
//            $this->photo = getenv('CATEGORY_DEFAULT_PHOTO_NAME');
//        }
//    }
//    public function getPhoto()
//    {
//        $name = substr_replace($this->photo, '/', 4, 0);
//        $name = substr_replace($name, '/', 2, 0);
//        return '/web/'. getenv('CATEGORY_LOCATION_PATH') . $name;
//    }
}
