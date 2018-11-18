<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 14.11.2018
 * Time: 4:38
 */

namespace app\models;

use yii\db\ActiveRecord;
class Article extends  ActiveRecord
{
    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }
}