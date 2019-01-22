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

    <div class="row gtr-uniform">
    <article>
        <p>
            <span class="image right">
                <?= yii\helpers\Html::img(Yii::$app->photoStorage->getImagePath($model->photo,\app\models\entities\Article::LOCATION_PATH)) ?>
                <p></p>
                <h1><?= Html::encode($this->title) ?></h1>
                <p></p>
            </span>
        </p>
    </article>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
