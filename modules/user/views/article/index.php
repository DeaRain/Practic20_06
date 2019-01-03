<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\ModuleUser;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список статей';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую статью', ['create'], ['class' => 'btn btn-success']) ?>
    <div class="image right">
        <input type="checkbox" id="moder" onchange="MAcheck()" <?php if($moder=='ok') echo 'checked'?> >
        <label for="moder">На модерации</label>
        <input type="checkbox" id="active" onchange="MAcheck()" <?php if($active=='ok') echo 'checked'?> >
        <label for="active">Активнен</label>
    </div>
    </p>

    <?php
    $name="asd";
    echo
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
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
                'value'=>function($data,$name="admin"){
                    return ModuleUser::findOne(['id'=>$data->author])->username;
                }],
            ['attribute'=>'status',
                'value'=>function($data){
                    return $data->userStatus;
                }],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<script type="text/javascript">
    chboxM=document.getElementById('moder');
    chboxA=document.getElementById('active');
    function MAcheck(){
        var MAurl="?moder=no";

        if(chboxM.checked) {
            MAurl="?moder=ok";
        }
        if(chboxA.checked) {
            MAurl=MAurl+ "&active=ok"
        }
        window.location.href = "/user/article/index"+MAurl;
    }
</script>
