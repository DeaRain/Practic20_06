<?php
namespace app\models\services;

use app\models\entities\Article;
use app\models\forms\ArticleSearchForm;
use yii\data\ActiveDataProvider;

class SearchService
{
    public function searchArticle(ArticleSearchForm $form, $params, $pageSize = 6)
    {
        $query = Article::find();

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

        $query->andFilterWhere([
            'id' => $form->id,
            'category_id' => $form->category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $form->name])
            ->andFilterWhere(['like', 'content', $form->content]);

        return $dataProvider;
    }

}