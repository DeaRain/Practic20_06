<?php
namespace app\models\modules\services;

use app\models\entities\Article;
use app\models\entities\Category;
use app\models\forms\ArticleForm;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use app\models\modules\forms\CategoryForm;
use Yii;
use yii\data\ActiveDataProvider;

class CategoryGridService
{
    public function EntityToForm(Category $model){
        $form = new CategoryForm();
        $form->name = $model->name;
        $form->descr = $model->descr;
        $form->photo = $model->photo;
        return $form;
    }

    public function save(CategoryForm $form){

       $this->photoTransform($form);

       $category = Category::create($form->name,
           $form->descr,
           $form->photo
       );
       return $category->save();
    }

    public function update(Category $model,CategoryForm $form){

        $this->photoTransform($form);

        $model->name = $form->name;
        $model->descr = $form->descr;
        $model->photo = $form->photo;

        return $model->save();
    }



    private function photoTransform(CategoryForm $form){
        if($form->validate('imageFile')) {
            $form->photo = Yii::$app->photoStorage->saveImage($form->imageFile, Category::LOCATION_PATH);
        } else {
            $form->photo = Article::DEF_PHOTO;
        }
    }
}