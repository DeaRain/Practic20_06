<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearchForm extends Model
{
    public $name;
    public $content;
    public $id;
    public $category_id;
    public $author;
    public $status;

    public function rules()
    {
        return [
            [['id', 'category_id', 'author', 'status'], 'integer'],
            [['name', 'content'], 'safe'],
        ];
    }
}
