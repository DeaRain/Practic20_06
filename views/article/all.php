<?php

/* @var $this yii\web\View */

$this->title = 'Категория: '.$category['name'];

?>
<!-- Banner -->
<section id="banner">
    <div class="content">
        <header>
            <h1><?=$category['name']?></h1>
        </header>
        <p><?=$category['descr']?></p>
    </div>
    <span class="image object">
<img src="/images/all/<?=$category['id']?>.jpg" alt="" />
</span>
</section>


<!-- Section -->
<section>

    <div class="posts">

        <?php foreach ($articles as $article){?>

        <article>
            <a href="#" class="image"><img src="/images/article/<?=$article['id']?>.jpg" alt="" /></a>
            <h3><?= $article['name']?></h3>
            <p><?php $contain =  \yii\helpers\StringHelper::truncate(strip_tags($article['content']),200,'...');
            echo $contain;?></p>
            <ul class="actions">
                <li><a href="<?= \yii\helpers\Url::to((['article/view','id'=>$article['id']]))?>" class="button">Подробней</a></li>
            </ul>
        </article>
        <?php }?>
    </div>
    <div align="center">
<?= \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
    'prevPageLabel' => '&laquo; Назад',
    'nextPageLabel' => 'Далее &raquo;',
]);?>
    </div>
</section>
