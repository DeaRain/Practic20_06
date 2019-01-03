<?php
/* @var $this yii\web\View */
$this->title = $article["name"];
$this->params['breadcrumbs'][] = [
    'label' => 'Все категории', // название ссылки
    'url' => [\yii\helpers\Url::to(['/article/category'])] // сама ссылка
];
$this->params['breadcrumbs'][] = [
    'label' => $article->category->name, // название ссылки
    'url' => [\yii\helpers\Url::to(['/article/all','id'=>$article->category->id])] // сама ссылка
];
$this->params['breadcrumbs'][] = $this->title;
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