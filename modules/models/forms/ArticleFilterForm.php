<?php

namespace app\modules\models\forms;

use yii\base\Model;

class ArticleFilterForm extends Model
{
    public $status = 2;

    public function rules()
    {
        return [
            ['status', 'integer'],
        ];
    }
}
