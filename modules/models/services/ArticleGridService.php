<?php
namespace app\modules\models\services;

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

    public function getArticleForm(Article $model){
        $form = new ArticleForm();
        $form->category_id = $model->category_id;
        $form->name = $model->name;
        $form->content = $model->content;
        $form->author = $model->author;
        $form->status = $model->status;
        $form->photo = $model->photo;
        return $form;
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

    public function update(Article $model,ArticleForm $form){

        $model->category_id = $form->category_id;
        $model->name = $form->name;
        $model->content = $form->content;
        $model->author = $form->author;
        $model->status = $form->status;
        $model->photo = $form->photo;

        return $model->save();
    }
}