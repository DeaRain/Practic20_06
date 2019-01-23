<?php
namespace app\models\modules\services;

use app\models\entities\Article;
use app\models\forms\ArticleForm;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use app\models\modules\forms\ArticleAdminForm;
use app\models\repositories\ArticleRepository;
use Yii;
use yii\data\ActiveDataProvider;

class ArticleGridService
{
    public function getQueryFilter($authorId, $active, $onCheck)
    {
        $queryFilter = ['author'=>$authorId];
        if($active=="ok"&&$onCheck=="ok") {
        } elseif ($active=="ok") {
            $queryFilter = ['status'=>1,'author'=>$authorId];
        } elseif ($onCheck=="ok") {
            $queryFilter = ['status'=>0,'author'=>$authorId];
        }
        return $queryFilter;
    }

    public function EntityToForm(Article $model){
        $form = new ArticleForm();
        $form->category_id = $model->category_id;
        $form->name = $model->name;
        $form->content = $model->content;
        $form->author = $model->author;
        $form->status = $model->status;
        $form->photo = $model->photo;
        return $form;
    }

    public function save(ArticleForm $form){

       $this->photoTransform($form);

       $article = Article::create($form->category_id,
           $form->name,
           $form->content,
           $form->author,
           $form->status,
           $form->photo
       );
       return $article->save();
    }

    public function update(Article $model,ArticleForm $form){

        $this->photoTransform($form);

        $model->category_id = $form->category_id;
        $model->name = $form->name;
        $model->content = $form->content;
        $model->author = $form->author;
        $model->status = $form->status;
        $model->photo = $form->photo;

        return $model->save();
    }

    public function getUserArticle($articleId, $userId){
        $article = (new ArticleRepository())->findModel($articleId);
        if($article->author == $userId){
            return $article;
        }
        return null;
    }
    private function photoTransform($form){
        if($form->validate('imageFile')) {
            $form->photo = Yii::$app->photoStorage->saveImage($form->imageFile, Article::LOCATION_PATH);
        } else {
            $form->photo = Article::DEF_PHOTO;
        }
    }
}