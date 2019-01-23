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
            'email:email',
            ['attribute'=>'role',
                'value'=>function($data){
                    return (new \app\models\repositories\RBACRepository())->getUserRole($data->id);
                }],
            ['attribute'=>'status',
                'value'=>function($data){
                    return (new \app\modules\models\services\ProfileService())->userStatus($data);
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
