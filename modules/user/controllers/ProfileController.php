<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 18.11.2018
 * Time: 14:00
 */

namespace app\modules\user\controllers;
use app\models\ModuleUser;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $thisUser = ModuleUser::findOne(['id'=>\Yii::$app->user->getId()]);
        $user = [
            'name'=>$thisUser->username,
            'banned'=>'0'
            ];
        if($thisUser->status==1) {
            $user['banned'] = 1;
        }
        return $this->render('index',compact('user'));
    }
}