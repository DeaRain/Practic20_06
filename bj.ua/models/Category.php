<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 14.11.2018
 * Time: 4:34
 */

namespace app\models;

use yii\db\ActiveRecord;
class Category extends ActiveRecord
{
    public function getArticles(){
    return $this->hasMany(Article::className(),['category_id'=>'id']);
}
}