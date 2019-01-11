<?php

namespace app\controllers;

use app\models\Category;
use yii\web\Controller;
use app\models\Article;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    public function actionCategory()
    {
        $categoryes = Category::find()->all();
        return $this->render('categoryes',compact('categoryes'));
    }
    public function actionView($id=null)
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
        return $this->render('view',compact('provider','category'));
    }


}
