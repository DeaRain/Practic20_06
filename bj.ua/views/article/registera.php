<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Регистрация админа';
?>


<p>
<?php $form = ActiveForm::begin(); ?>

<p><?= $result ?></p>
<?= $form->field($regmodel, 'username') ?>
<p>
<?= $form->field($regmodel, 'password')->passwordInput()?>
<p>
<ul class="actions">
    <li><?= Html::submitButton('Регистрация', ['class' => 'primary']) ?></li>
    <li><a href=" <?= Url::to(['site/login']); ?>"  class="button fit" >Вернуться к авторизации</a></li>
</ul>


<?php ActiveForm::end(); ?>

