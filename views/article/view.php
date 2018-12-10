<?php
/* @var $this yii\web\View */
$this->title = $article["name"];
?>

<section>

    <header class="main">
        <h1><?= $article['name']?></h1>
    </header>

    <span class="image main">
        <?= yii\helpers\Html::img('/images/article/'.$article['id'].'.jpg') ?>
    </span>

    <?= $article['content']?>

</section>