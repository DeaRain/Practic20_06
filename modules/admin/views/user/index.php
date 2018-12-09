<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            ['attribute'=>'auth_key',
                'value'=>function($data){
                    return \yii\helpers\StringHelper::truncate(strip_tags( $data->auth_key),10,'..');
                }],
            ['attribute'=>'password_hash',
                'value'=>function($data){
                    return \yii\helpers\StringHelper::truncate(strip_tags( $data->password_hash),10,'..');
                }],
           // 'password_reset_token',
            'email:email',
            ['attribute'=>'status',
                'value'=>function($data){
                    if($data->status==1){ return 'Заблокирован';}
                    elseif($data->status==10) return 'Активный';
                    else $data->status;
                }],
            ['attribute'=>'created_at',
                'value'=>function($data){
                    return Yii::$app->formatter->asDate($data->created_at,'yyyy-MM-dd');
                }],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
