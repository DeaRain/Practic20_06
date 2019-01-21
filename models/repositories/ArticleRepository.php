<?php
namespace app\models\repositories;

use app\models\entities\Article;
use app\models\entities\User;

class ArticleRepository
{
    public function findById($id)
    {
        return Article::find()->where(['id'=>$id])->limit(1)->one();
    }
}