<?php
/* @var $this yii\web\View */
$this->title = $article["name"];
?>

<section>
    <header class="main">
        <h1><?= $article['name']?></h1>
    </header>
    <span class="image main"><img src="/images/article/<?= $article['id']?>.jpg" alt="" /></span>
    <?= $article['content']?>
</section>