<?php
namespace app\modules\models\services;

use app\models\entities\Article;
use app\modules\models\forms\ArticleForm;
use app\models\repositories\ArticleRepository;
use Yii;

class ArticleGridService
{
    public function EntityToForm(Article $model)
    {
        $form = new ArticleForm();
        $form->category_id = $model->category_id;
        $form->name = $model->name;
        $form->content = $model->content;
        $form->author = $model->author;
        $form->status = $model->status;
        $form->photo = $model->photo;
        return $form;
    }

    public function create(ArticleForm $form)
    {
       $article = Article::create(
           $form->category_id,
           $form->name,
           $form->content,
           $form->author,
           $form->status
       );

       $article->setPhoto($form->imageFile);
       if((new ArticleRepository())->save($article)){
           return $article->id;
       }

       return false;
    }

    public function update(Article $article,ArticleForm $form)
    {
        $article->edit($form->category_id, $form->name, $form->content, $form->author, $form->status);

        $article->setPhoto($form->imageFile);

        return (new ArticleRepository())->save($article);
    }

    public function getUserArticle($articleId, $userId)
    {
        $article = (new ArticleRepository())->findModel($articleId);
        if($article->author == $userId){
            return $article;
        }
        return null;
    }

    public function remove($id)
    {
        $article = (new ArticleRepository())->findModel($id);
        return (new ArticleRepository())->remove($article);
    }

    public function removeByEntiti($article)
    {
        return (new ArticleRepository())->remove($article);
    }
}