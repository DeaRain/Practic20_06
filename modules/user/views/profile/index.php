<?php

use yii\helpers\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Личный кабинет</h1>
<p><h2>Ваш никнем <?= $user['username']?></h2>
<p>
<p>
<?= Html::a('Мои статьи', ['/user/article'], ['class' => 'btn btn-success']) ?>