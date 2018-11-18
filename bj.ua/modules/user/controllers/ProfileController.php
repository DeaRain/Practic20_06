<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 18.11.2018
 * Time: 14:00
 */

namespace app\modules\user\controllers;
use app\modules\user\models\Profile;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $thisuser = Profile::findOne(['id'=>\Yii::$app->user->getId()]);
        return $this->render('index',compact('thisuser'));

    }
}