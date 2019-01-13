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
            'id',
            ['attribute'=>'category_id',
                'value'=>function($data){
                   return $data->category->name;
                }],
            'name',
            ['attribute'=>'content',
                'value'=>function($data){
                    return \yii\helpers\StringHelper::truncate(strip_tags( $data->content),200,'..');
                }],
            ['attribute'=>'author',
                'value'=>function($data){
                    return $data->user->username;
                }],
            ['attribute'=>'photo',
                'value'=>function($data){
                    return $data->photoPath;
                },
                'format' => ['image',['width'=>'100']]
            ],
          ['attribute'=>'status',
                'value'=>function($data){
                        return $data->textStatus;
                }],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
