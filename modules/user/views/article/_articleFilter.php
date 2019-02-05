<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => 'Активен',
        '0' => 'На модерации',
        '2' => 'Отображать все',
    ],
    [
        'class'=>'span',
        'onchange'=>'this.form.submit()',
    ])->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>
