<?php

namespace app\models\forms;

use yii\base\Model;

class ArticleSearchForm extends Model
{
    public $name;
    public $content;

    public function rules()
    {
        return [
            [['name', 'content'], 'safe'],
        ];
    }
}
