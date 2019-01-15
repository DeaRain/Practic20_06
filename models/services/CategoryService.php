<?php
namespace app\models\services;

use app\models\entities\Article;
use yii\data\ActiveDataProvider;

class CategoryService
{
    public function getProvider($id,$pageSize = 4,$active = 1,$order = SORT_DESC)
    {
        $query = Article::find()->where(['category_id'=>$id,'status'=>$active]);
        return $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => $order,
                ]
            ],
        ]);
    }

}