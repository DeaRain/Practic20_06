<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 18.11.2018
 * Time: 14:00
 */
namespace app\modules\user\controllers;

use app\models\repositories\UserRepository;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $user = (new UserRepository())->findModel(\Yii::$app->user->getId());
        return $this->render('index',compact('user'));
    }

    public function actionBanned()
    {
        $user = (new UserRepository())->findModel(\Yii::$app->user->getId());
        return $this->render('banned',compact('user'));
    }
}