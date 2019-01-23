<?php

namespace app\models\forms;

use yii\base\Model;

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
