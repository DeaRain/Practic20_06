<?php
namespace app\modules\models\services;

use app\models\entities\Article;
use app\models\repositories\ArticleRepository;
use app\modules\models\forms\ArticleFilterForm;
use yii\data\ActiveDataProvider;

class ArticleFilterService
{
    public function getSearchProvider($userId ,ArticleFilterForm $form, $params, $pageSize = 6)
    {
        $query = (new ArticleRepository())->getQueryWithAndWhere(["category"], ['author'=>$userId]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->pagination->pageSize = $pageSize;
        $form->load($params);

        if (!$form->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($form->status != 2) {
            $query->andFilterWhere(['like', 'status', $form->status]);
        }

        return $dataProvider;
    }
}
