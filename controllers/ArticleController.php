<?php

namespace app\controllers;
use app\models\Category;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Article;

class ArticleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAll($id=null)
    {
        if(!$id) return $this->redirect('/');
        $category = Category::find()->where(['id'=>$id])->limit(1)->one();
        $query = Article::find()->where(['category_id'=>$id,'status'=>'1']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('all',compact('articles','category','pages'));
    }

    public function actionView($id)
    {
        $article = Article::find()->where(['id'=>$id])->limit(1)->one();
        return $this->render('view',compact('article'));
    }
}
