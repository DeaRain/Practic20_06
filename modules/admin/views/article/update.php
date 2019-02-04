<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form app\modules\models\forms\ArticleForm */
/* @var $article app\models\entities\Article */

$this->title = 'Измененье статьи : ' . $article->name;
$this->params['breadcrumbs'][] = ['label' => 'Список статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $article->name, 'url' => ['view', 'id' => $article->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">

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

    <?= $this->render('_form', [
        'model' => $form,
    ]) ?>

</div>
