
<article>
    <a href="#" class="image"><img src="/images/article/<?=$model->id?>.jpg" alt="" /></a>
    <h3><?= $model->name?></h3>
    <p><?php $contain =  \yii\helpers\StringHelper::truncate(strip_tags($model->content),200,'...');
        echo $contain;?></p>
    <ul class="actions">
        <li><a href="<?= \yii\helpers\Url::to((['article/view','id'=>$model->id]))?>" class="button">Подробней</a></li>
    </ul>
</article>
