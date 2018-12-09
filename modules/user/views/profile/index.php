<?php
use yii\helpers\Html;
$this->title = 'Личный кабинет';?>
<h1>Личный кабинет</h1>
<p> <h2>Ваш никнем <?= $user['name']?> </h2></p>

<?php if ($user['banned']) {
   echo '<p> <h2>Вы заблокированы  </h2></p>';
}
else {
?>
    <p>
        <?= Html::a('Мои статьи', ['/user/article'], ['class' => 'btn btn-success']) ?>
    </p>
 <?php
}
?>