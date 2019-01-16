<?php
namespace app\models\services;

use app\models\entities\Article;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use Yii;
use yii\data\ActiveDataProvider;

class ArticleGridService
{
    public function getQueryFilter($authorId, $active, $onCheck)
    {
        $queryFilter = ['author'=>$authorId];
        if($active=="ok"&&$onCheck=="ok") {
        } elseif ($active=="ok") {
            $queryFilter = ['status'=>1,'author'=>Yii::$app->user->getId()];
        } elseif ($onCheck=="ok") {
            $queryFilter = ['status'=>0,'author'=>Yii::$app->user->getId()];
        }
        return $queryFilter;
    }

    public function getDataProvider($queryFilter, $pageSize = 20)
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->with('category')->where($queryFilter),
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
    }
}