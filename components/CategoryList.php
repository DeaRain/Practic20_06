<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 30.12.2018
 * Time: 19:18
 */
namespace app\components;

use app\models\Category;
use yii\base\Widget;
use yii\helpers\Url;

class CategoryList extends Widget{

    public $title;
    public $limit;

    public function init()
    {
        parent::init();
        if ($this->title === null) {
            $this->title = 'Список категорий';
        }
        if ($this->limit === null) {
            $this->limit = 10;
        }
    }

    public function run()
    {
        $title ='<header class="major">
                    <h2>'.$this->title.'</h2>
                 </header>';
        $content = '<ul>';
        $categoryes = Category::find()->limit($this->limit)->all();
        foreach ($categoryes as $category){
            $content.= '<li><a href='.Url::to(['/article/all','id'=>$category['id']]). '>'.$category['name'].'</a></li>';
        }

        if(count($categoryes)==$this->limit){
            $content.= '<li><a href='.Url::to(['/article/category']). ' style="color:#00b027" >Посмотреть другие категории..</a></li>';
        }



        $content =$title. $content. '</ul>';
        return $content;
    }
}