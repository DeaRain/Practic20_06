<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список статей';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-5">
                <?= Html::a('Создать новую статью', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="col-7"">
                 <div style="padding-right: 20px">
                     <?= $this->render('_articleFilter', ['model' => $searchModel]) ?>
                </div>
            </div>
        </div>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['attribute'=>'category_id',
                'value'=>function($data){
                     return $data->category->name;
                }],
            'name',
            ['attribute'=>'content',
                'value'=>function($data){
                    return StringHelper::truncate(strip_tags( $data->content),200,'..');
                }],
            ['attribute'=>'author',
                'value'=>function($data){
                    return $data->user->username;
                }],
            ['attribute'=>'photo',
                'value'=>function($data){
                    return $data->getPhoto();
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

