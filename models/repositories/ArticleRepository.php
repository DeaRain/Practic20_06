<?php
namespace app\models\repositories;

use app\models\entities\Article;
use app\models\entities\User;
use yii\web\NotFoundHttpException;

class ArticleRepository
{
    public function findById($id)
    {
        return Article::find()->where(['id'=>$id])->limit(1)->one();
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
    public function getQueryWith(array $with)
    {
        return Article::find()->with($with);
    }
}