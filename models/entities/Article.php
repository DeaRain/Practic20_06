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
 * @property User $author0
 * @property Category $category
 */
class Article extends \yii\db\ActiveRecord
{
    public $imageFile;
    const DEFAULT_LOGO_PATH = "default.jpg";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
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
            'photo' => 'Главное фото',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorName()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getTextStatus()
    {
        if($this->status){
            return 'Активен';
        } else {
            return 'Отключен';
        }
    }
    public function getUserStatus()
    {
        if($this->status){
            return 'Активен';
        } else {
            return 'На модерации';
        }
    }
    public function uploadPhoto(){
        if($this->validate('imageFile')){
            return Yii::$app->photoStorage->saveImage($this->imageFile);
        }else{
            return self::DEFAULT_LOGO_PATH;
        }
    }
    public function getPhotoPath(){
        return Yii::$app->photoStorage->getImagePath($this->photo);
    }
    public static function findById($id){
        return self::find()->where(['id'=>$id])->limit(1)->one();
    }
    public function getCategoryName(){
        return $this->category->name;
    }
}
