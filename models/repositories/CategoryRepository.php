<?php
namespace app\models\repositories;

use app\models\entities\Category;
use yii\web\NotFoundHttpException;

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
}
