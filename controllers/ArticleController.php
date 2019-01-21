<?php

namespace app\controllers;

use app\models\forms\ArticleSearchForm;
use app\models\repositories\ArticleRepository;
use app\models\services\SearchService;
use yii\web\Controller;
use Yii;

class ArticleController extends Controller
{
    public function actionView($id)
    {
        $article = (new ArticleRepository())->findById($id);
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
