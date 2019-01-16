<?php
namespace app\models\services;

use app\models\entities\Article;
use app\models\forms\ArticleForm;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use Yii;
use yii\data\ActiveDataProvider;

class ArticleGridService
{
    const DEFAULT_LOGO_PATH = "default.jpg";
    public function getQueryFilter($authorId, $active, $onCheck)
    {
        $queryFilter = ['author'=>$authorId];
        if($active=="ok"&&$onCheck=="ok") {
        } elseif ($active=="ok") {
            $queryFilter = ['status'=>1,'author'=>Yii::$app->user->getId()];
        } elseif ($onCheck=="ok") {
            $queryFilter = ['status'=>0,'author'=>Yii::$app->user->getId()];
        }
        return $queryFilter;
    }

    public function getDataProvider($queryFilter, $pageSize = 20)
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->with('category')->where($queryFilter),
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
    }

    public function uploadPhoto(ArticleForm $form){

        if($form->validate('imageFile')) {
            return $photoName = Yii::$app->photoStorage->saveImage($form->imageFile);
        } else {
            return $photoName = ArticleGridService::DEFAULT_LOGO_PATH;
        }
    }

    public function getUserArticle($articleId, $userId){
        $article = $this->getArticle($articleId);
        if($article->author == $userId){
            return $article;
        }
        return null;
    }
    public function getArticle($id){
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }
    }

    public function save(ArticleForm $form){
       $article = Article::create($form->category_id,
           $form->name,
           $form->content,
           $form->author,
           0,
           $form->photo
       );
       return $article->save();
    }
}