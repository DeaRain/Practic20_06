
<article>

    <a href=<?=\yii\helpers\Url::to((['article/view','id'=>$model->id]))?> class="image">
    <?= yii\helpers\Html::img($model->photoPath)?>
    </a>

    <h3><?=$model->name?></h3>

    <p>
        <?=\yii\helpers\StringHelper::truncate(strip_tags($model->content),200,'...'); ?>
    </p>

    <ul class="actions">
        <li><a href="<?= \yii\helpers\Url::to((['article/view','id'=>$model->id]))?>" class="button">Подробней</a></li>
    </ul>

</article>
