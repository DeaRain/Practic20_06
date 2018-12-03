<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'banned')->textInput() ?>


    <?= $form->field($model, 'banned')->dropDownList([
        '1' => 'Заблокирован',
        '0' => 'Активный',
    ]); ?>


    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
