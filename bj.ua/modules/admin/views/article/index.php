<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список статей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'category_id',
            ['attribute'=>'category_id',
                'value'=>function($data){
                    //print_r($data);
//                    return \app\models\Category::findOne(['id'=>$data->category_id])->name;
                    return $data->category->name;
                }],
            'name',
//            'content:ntext',

            ['attribute'=>'content',
                'value'=>function($data){
                    return \yii\helpers\StringHelper::truncate(strip_tags( $data->content),200,'..');
                }],
            ['attribute'=>'author',
                'value'=>function($data){
//                    return \app\models\User::findOne(['id'=>$data->author])->username;
                    return $data->user->username;
                }],
//            'author',
            ['attribute'=>'status',
                'value'=>function($data){
        if($data->status){ return 'Активен';}
        else return 'Отключен';
                }],
//            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
