<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Article;
use app\models\ArticleSearch;
use Yii;

class ArticleController extends Controller
{
    public function actionView($id)
    {
        $article = Article::find()->where(['id'=>$id])->limit(1)->one();
        $catName= $article->category->name;
        return $this->render('view',compact('article','catName'));
    }

    public function actionSearch()
    {
        $searchModel = new ArticleSearch();
        if(!Yii::$app->request->queryParams) {
            return $this->render('search', [
                'searchModel' => $searchModel,
                'status'=>'0'
            ]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=6;
        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status'=>'1',
        ]);
    }
}
