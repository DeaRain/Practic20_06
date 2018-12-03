<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Article */

$this->title = 'Измененье статьи : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">

    <article>
        <p><span class="image right"><img src="/images/article/<?=$model['id']?>.jpg" alt="" /> <p>
        <h1><?= Html::encode($this->title) ?></h1>
        </p> </span></p>
    </article>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
