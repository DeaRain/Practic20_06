<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Category;
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
            <header id="header">
                <a href="/" class="logo"><strong>На главную страницу</strong></a>
                <ul class="icons">
                    <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
                    <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
                </ul>
            </header>

            <?= $content ?>

        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner">

            <!-- Search -->
            <section id="search" class="alt">
                <form method="post" action="#">
                        <input type="text" name="query" id="query" placeholder="Search" />
                </form>
            </section>


              <!-- Menu -->
            <nav id="menu">

                <?php if(!Yii::$app->user->isGuest) {
                    if(Yii::$app->user->can('isAdmin')){ ?>
                        <header class="major">
                            <h2>Инструментарий</h2>
                        </header>
                            <ul>
                                <?php
                                echo '<li><a href='.\yii\helpers\Url::to(['/admin/category']). '>
                           Управление категориями </a></li>';
                                echo '<li><a href='.\yii\helpers\Url::to(['/admin/article']). '>
                           Управление статьями </a></li>';
                                echo '<li><a href='.\yii\helpers\Url::to(['/admin/user']). '>
                           Список пользователей </a></li> <p></p>';
                                ?>
                            </ul>
                    <?php }
                }?>





                <?php $auth = Yii::$app->authManager;
                if(!$auth->getRole('user')) echo " <p> <a href=\"/article/test\" class=\"button primary fit\">Регистрация ролей</a> </p>";
                else {
                    if(Yii::$app->user->isGuest) {
                    echo '<a href="/site/login" class="button primary fit">Авторизация</a>';
                    echo '<p><p><a href="/site/register" class="button primary fit">Регистрация</a>';
                    echo '<p><p><a href="/site/register?userType=admin" class="button primary fit">Регистрация Админа</a>';
                }
                else {
                    echo '<a href="/user" class="button primary fit">Личный Кабинет</a>';
                    echo '<p><p><a href="/site/logout" class="button primary fit">'.'Logout (' . Yii::$app->user->identity->username . ')'.'</a></p>';
                }
                }
                ?>
                <header class="major">
                    <h2>Категории</h2>
                </header>
                <ul>
                    <?php
                    $temp = Category::find()->all();
                     foreach ($temp as $category){
                         echo '<li><a href='.\yii\helpers\Url::to(['/article/all','id'=>$category['id']]). '>'.$category['name'].'</a></li>';
                     }
                    ?>
                </ul>
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