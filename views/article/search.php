<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>Показано <b>1-<?=$dataProvider->count?></b> из <b><?=$dataProvider->totalCount?></b>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '..\_itemView\_post',
            'options' => [
                'class' => 'posts'
            ],
            'layout' => "{items}",
            'itemOptions' => [
                'tag' => null,
            ],
            'emptyText' => 'Ничего не найдено',
            'emptyTextOptions' => [
                'tag' => 'article'
            ],

        ]); ?>

    <div align="center">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'nextPageLabel' => 'Следующая',
                'prevPageLabel' => 'Предыдущая',
                'maxButtonCount' => 5,
                'options' => [
                    'class' => 'pagination',
                ],
            ]); ?>
    </div>


<!--    </section>-->



</div>
