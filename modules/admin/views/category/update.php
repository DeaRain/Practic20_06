<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = 'Изменение категории : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <article>
        <p>
            <span class="image right">
                <?= yii\helpers\Html::img('/images/all/'.$model['id'].'.jpg') ?>
                <p>
                <h1><?= Html::encode($this->title) ?></h1>
                </p>
            </span>
        </p>
    </article>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
