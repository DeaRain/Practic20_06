<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'category_id')->textInput() ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(),'id','name')) ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\User::find()->all(),'id','username')) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => 'Активный',
        '0' => 'Отключен',
    ]); ?>




<!--    --><?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'content')->widget(CKEditor::className(),[

    'editorOptions' => ElFinder::ckeditorOptions(['elfinder','path' => 'userId_'.$model->author],[
        'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
        'filter' => 'image',
    ]),
]);?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
