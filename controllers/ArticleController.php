<?php

namespace app\controllers;

use app\models\Category;
use yii\web\Controller;
use app\models\Article;
use yii\data\ActiveDataProvider;
use app\models\ArticleSearch;
use Yii;

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

    public function actionSearch($query=null)
    {
        $searchModel = new ArticleSearch();

        if($query!=null){
            $searchModel->name = $query;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=6;
        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
