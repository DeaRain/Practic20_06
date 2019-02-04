<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\models\forms\ArticleForm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">


    <article>

        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <p></p>
        <p><a href=<?=\yii\helpers\Url::to(['/article/view','id'=>$model['id']])?> >Просмотр на сайте</a></p>
        <p></p>
        </span>
        </p>
    </article>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute'=>'category_id',
                'value'=>function($data){
                    return $data->category->name;
                }],
            ['attribute'=>'author',
                'value'=>function($data){
                    return $data->user->username;
                }],
            ['attribute'=>'status',
                'value'=>function($data){
                    return $data->textStatus;
                }],
            'name',
            ['attribute'=>'photo',
                'value'=>function($data){
                    return $data->getPhoto();
                },
                'format' => ['image',['height'=>'200']]
                ],
            'content:ntext',
        ],
    ]) ?>

</div>
