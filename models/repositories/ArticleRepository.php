<?php
namespace app\models\repositories;

use app\models\entities\Article;
use yii\web\NotFoundHttpException;

class ArticleRepository
{
    public function getCleanQuery()
    {
        return Article::find();
    }

    public function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The article does not exist.');
    }

    public function getQueryWithAndWhere(array $with,array $where)
    {
        return Article::find()->with($with)->where($where);
    }
    public function getQueryWhere(array $where)
    {
        return Article::find()->where($where);
    }
    public function getQueryWith(array $with)
    {
        return Article::find()->with($with);
    }
}
