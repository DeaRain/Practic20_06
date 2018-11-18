<?php

namespace app\modules\user\controllers;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        // перенаправляем браузер пользователя на http://example.com
        return $this->redirect('/user/profile');
    }


    public function actionIndex()
    {
        return $this->render('index');
    }
}
