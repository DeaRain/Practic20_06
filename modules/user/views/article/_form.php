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

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \app\models\repositories\CategoryRepository())->getAllQuery(),'id','name')) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'author')->hiddenInput(['value'=>Yii::$app->user->getId()]) ->label(''); ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder','path' => getenv(EDITOR_USER_FOLDER).Yii::$app->user->getId()],[
        'preset' => getenv('EDITOR_OPTIONS_PRESENT'), //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
        'filter' => 'image',
    ]),
]);?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
