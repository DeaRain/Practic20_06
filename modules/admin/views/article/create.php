<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\models\forms\ArticleForm */

$this->title = 'Создание статьи';
$this->params['breadcrumbs'][] = ['label' => 'Список статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
