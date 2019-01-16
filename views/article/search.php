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
    <section>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '..\_itemView\_post',
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



</div>
