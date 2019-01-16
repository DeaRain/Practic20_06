<?php

namespace app\controllers;

use app\models\forms\ArticleSearchForm;
use app\models\services\SearchService;
use yii\web\Controller;
use app\models\entities\Article;
use app\models\entities\ArticleSearch;
use Yii;

class ArticleController extends Controller
{
    public function actionView($id)
    {
        $article = Article::findById($id);
        $catName = $article->categoryName;
        return $this->render('view',compact('article','catName'));
    }

    public function actionSearch()
    {
        $searchModel = new ArticleSearchForm();
        $dataProvider = (new SearchService())->searchArticle($searchModel, Yii::$app->request->queryParams);

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
