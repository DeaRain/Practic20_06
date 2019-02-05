<?php

namespace app\controllers;

use app\models\forms\ArticleSearchForm;
use app\models\repositories\ArticleRepository;
use app\models\services\SearchService;
use yii\web\Controller;
use Yii;
use yii\web\ForbiddenHttpException;

class ArticleController extends Controller
{
    public function actionView($id)
    {
        $article = (new ArticleRepository())->findModel($id);
        if($article->status == 0 && $article->author != Yii::$app->user->getId()) throw new ForbiddenHttpException('Article under review');
        $catName = $article->category->name;

        return $this->render('view',compact('article','catName'));
    }

    public function actionSearch()
    {
        $searchModel = new ArticleSearchForm();
        $dataProvider = (new SearchService())->getSearchProvider($searchModel, Yii::$app->request->queryParams);

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
