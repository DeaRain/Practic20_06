<?php

namespace app\controllers;

use app\models\repositories\ArticleRepository;
use app\models\repositories\CategoryRepository;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    public function actionCategory()
    {
        $categoryes = (new CategoryRepository())->getAllQuery();
        return $this->render('categoryes',compact('categoryes'));
    }
    public function actionView($id)
    {
        $category = (new CategoryRepository())->findModel($id);
        $query = (new ArticleRepository())->getQueryWhere(['category_id'=>$id,'status'=>1]);
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
        return $this->render('view',compact('provider','category'));
    }
}
