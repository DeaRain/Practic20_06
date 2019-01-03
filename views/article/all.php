<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;

$this->title = 'Категория: '.$category['name'];
$this->params['breadcrumbs'][] = [
    'label' => 'Все категории',
    'url' => [\yii\helpers\Url::to(['/article/category'])]
];
$this->params['breadcrumbs'][] = $this->title;
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
        <?= yii\helpers\Html::img('/images/all/'.$category['id'].'.jpg') ?>
    </span>
</section>

<!-- Section -->
<section>
        <?= ListView::widget([
            'dataProvider' => $provider,
                'itemView' => '_post',
            'options' => [
                'class' => 'posts'
            ],
            'layout' => "{items}</div><div align=\"center\">\n{pager}",
            'itemOptions' => [
                'tag' => null,
            ],
            'pager' => [
                'nextPageLabel' => 'Следующая',
                'prevPageLabel' => 'Предыдущая',
                'maxButtonCount' => 5,
                'options' => [
                    'class' => 'pagination'
                ],
            ],
        ]); ?>
</section>
