<?php

namespace app\controllers;

use app\models\entities\Category;
use app\models\repositories\CategoryRepository;
use app\models\services\CategoryService;
use yii\web\Controller;
use app\models\Article;
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
        $provider = (new CategoryService())->getProvider($id,4);
        return $this->render('view',compact('provider','category'));
    }


}
