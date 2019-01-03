<?php

use yii\helpers\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Личный кабинет</h1>
<p><h2>Ваш никнем <?= $user['name']?></h2>
<p>

<?php if ($user['banned']): ?>
    <p><h2>Вы заблокированы </h2>
    <p>

    <?php else: ?>
    <p><?= Html::a('Мои статьи', ['/user/article'], ['class' => 'btn btn-success']) ?>
    <p>
 <?php endif; ?>