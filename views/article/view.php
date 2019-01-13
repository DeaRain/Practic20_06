<?php
/* @var $this yii\web\View */
$this->title = $article["name"];
$this->params['breadcrumbs'][] = [
    'label' => 'Все категории',
    'url' => [\yii\helpers\Url::to(['/category/category'])]
];
$this->params['breadcrumbs'][] = [
    'label' => $article->category->name,
    'url' => [\yii\helpers\Url::to(['/category/view','id'=>$article->category->id])]
];
$this->params['breadcrumbs'][] = $this->title;
?>

<section>
    <header class="main">
        <h1><?= $article['name']?></h1>
    </header>

    <span class="image main">
        <?= yii\helpers\Html::img($article->photoPath) ?>
    </span>

    <?= $article['content']?>

</section>