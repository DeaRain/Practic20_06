<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;
$this->title = 'Все категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Section -->
<section >
    <H3>Список всех категорий</H3>
    <div  style="column-count: 3">
        <?php foreach($categoryes as $category):?>
            <?=\yii\helpers\Html::a("$category->name", ['category/view','id'=>$category->id], ['class' => 'list-group-item']); ?>
        <?php endforeach;?>
    </div>

</section>

