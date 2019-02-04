<?php
namespace app\models\repositories;

use app\models\entities\Category;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class CategoryRepository
{
    public function getCleanQuery()
    {
        return Category::find();
    }

    public function getAllQuery()
    {
        return Category::find()->all();
    }

    public function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The category does not exist.');
    }

    public function save(Category $category)
    {
        if (!$category->save()) {
            throw new ServerErrorHttpException('Saving error.');
        }
        return true;
    }

    public function remove(Category $category)
    {
        if (!$category->delete()) {
            throw new ServerErrorHttpException('Deleting error.');
        }
        return true;
    }
}
