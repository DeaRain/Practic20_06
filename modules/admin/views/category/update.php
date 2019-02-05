<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form app\modules\models\forms\CategoryForm */
/* @var $category app\models\entities\Category */

$this->title = 'Изменение категории : '.$category->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <article>
        <p>
            <span class="image right">
                <?= yii\helpers\Html::img($category->getPhoto())?>
                <p>
                <h1><?= Html::encode($this->title) ?></h1>
                </p>
            </span>
        </p>
    </article>
    <?= $this->render('_form', [
        'model' => $form,
    ]) ?>

</div>
