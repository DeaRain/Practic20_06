<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $article app\models\entities\Article */
/* @var $form app\modules\models\forms\ArticleForm */

$this->title = 'Измененье статьи : '.$article->name;
$this->params['breadcrumbs'][] = ['label' => 'Список статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $article->name, 'url' => ['view', 'id' => $article->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">

    <div class="row gtr-uniform">
    <article>
        <p>
            <span class="image right">
                <?= yii\helpers\Html::img($article->getPhoto()) ?>
                <p></p>
                <h1><?= Html::encode($this->title) ?></h1>
                <p></p>
            </span>
        </p>
    </article>
    </div>
    <?= $this->render('_form', [
        'model' => $form,
    ]) ?>

</div>
