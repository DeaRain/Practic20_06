<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<body class="is-preload">
<?php $this->beginBody() ?>

<!-- Wrapper -->
<div id="wrapper">
    <!-- Main -->
    <div id="main">
        <div class="inner">
            <!-- Header -->
            <header id="header" style="padding-top: 55px">
                <?= \yii\widgets\Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])?>
            </header>
            <?= $content ?>
        </div>
    </div>
    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner">
            <section id="search" class="alt">
                <a href='<?=Url::to(['/search'])?>' class="button primary fit icon fa-search">Поиск по сайту</a>
            </section>
              <!-- Menu -->
            <nav id="menu">

                <?php if(Yii::$app->user->can('isAdmin')): ?>
                    <header class="major">
                        <h2>Инструментарий</h2>
                    </header>
                        <ul>
                            <?php
                                echo '<li><a href='.Url::to(['/admin/category']).'> Управление категориями </a></li>';
                                echo '<li><a href='.Url::to(['/admin/article']).'> Управление статьями </a></li>';
                                echo '<li><a href='.Url::to(['/admin/user']).'> Список пользователей </a></li><p></p>';
                            ?>
                        </ul>
                <?php endif;?>

                <?php
                if(Yii::$app->user->can('isUser')) :
                    echo '<a href='.Url::to(['/user']).' class="button primary fit">Личный Кабинет</a>';
                    echo '<p><p><a href='.Url::to(['/auth/logout']).' class="button primary fit">'.'Logout (' . Yii::$app->user->identity->username . ')'.'</a></p>';
                else:
                    echo '<a href='.Url::to(['/auth/login']).' class="button primary fit">Авторизация</a>';
                    echo '<p><p><a href='.Url::to(['/auth/signup']).' class="button primary fit">Регистрация</a>';
                    echo '<p><p><a href='.Url::to(['/auth/signup','userType'=>'admin']).' class="button primary fit">Регистрация Админа</a></li>';
                endif; ?>

                <?= \app\widgets\CategoryList::widget([
                    'title' => 'Список категорий',
                    'limit'=>9,
                ]) ?>
            </nav>

            <!-- Footer -->
            <footer id="footer">
                <p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
            </footer>

        </div>
    </div>
</div>

<!-- Scripts -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>