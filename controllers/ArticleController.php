<?php

namespace app\controllers;

use app\models\Category;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Article;
use yii\data\ActiveDataProvider;

class ArticleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAll($id=null)
    {
        if(!$id) return $this->goHome();
        $category = Category::find()->where(['id'=>$id])->limit(1)->one();
        $query = Article::find()->where(['category_id'=>$id,'status'=>'1']);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 4,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('all',compact('provider','category'));
    }

    public function actionView($id)
    {
        $article = Article::find()->where(['id'=>$id])->limit(1)->one();
        return $this->render('view',compact('article'));
    }
}
