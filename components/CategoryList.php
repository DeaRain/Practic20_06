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
use yii\helpers\Html;
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





//        $categoryes = Category::find()->orderBy("updated_at DESC")->limit($this->limit)->all();
        $categoryes = Category::find()->limit($this->limit)->all();

        $menuList ='<ul class="list-group">';

        $menuList .='<li class="list-group-item" style="background: #D3D3D3">'.'<b>'.Html::encode($this->title).'</b></li>';

        foreach ($categoryes as $category){
            $item = Html::a(Html::encode($category->name), ['site/view-cat', 'id' => $category->id], ['class' => 'list-group-item']);
            $menuList .=$item;
        }

        if(count($categoryes)==$this->limit){
            $item = Html::a("Посмотреть другие категории..", ['site/category'], ['class' => 'list-group-item','style'=>'color: #CD5C5C']);

            $menuList .='<p></p>'. $item;
        }
        $menuList .="</ul>";
        return $menuList;
    }








//    public function run()
//    {
////        $categoryes = Category::find()->orderBy("updated_at DESC")->limit($this->limit)->all();
//        $categoryes = Category::find()->limit($this->limit)->all();
//
//        $menuList ='<ul class="list-group">';
//
//        $menuList .='<li class="list-group-item" style="background: #D3D3D3">'.'<b>'.Html::encode($this->title).'</b></li>';
//
//        foreach ($categoryes as $category){
//            $item = Html::a(Html::encode($category->name), ['site/view-cat', 'id' => $category->id], ['class' => 'list-group-item']);
//            $menuList .=$item;
//        }
//
//        if(count($categoryes)==$this->limit){
//            $item = Html::a("Посмотреть другие категории..", ['site/category'], ['class' => 'list-group-item','style'=>'color: #CD5C5C']);
//
//            $menuList .='<p></p>'. $item;
//        }
//        $menuList .="</ul>";
//        return $menuList;
//    }
}