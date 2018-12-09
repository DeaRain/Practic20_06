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
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $thisUser = Profile::findOne(['id'=>\Yii::$app->user->getId()]);
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