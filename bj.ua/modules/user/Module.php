<?php

namespace app\modules\user;
use app\modules\user\models\Profile;
use yii\filters\AccessControl;
use Yii;


/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
//    public function beforeAction($action)
//    {
//        // перенаправляем браузер пользователя на http://example.com
//        //return redirect('http://example.com');
//        $thisuser = Profile::findOne(['id'=>\Yii::$app->user->getId()]);
//        if($thisuser->banned) {
//            return Yii::$app->response->redirect('/user/profile');
//        }
//        else {
//            return $action;
//        }
//    }
    public function behaviors()
    {
        //if (Yii::$app->user->can('isAdmin')) return "you a banned";
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [

                    [
                        'allow' => true,
                        //  'actions' => ['index'],
                        'roles' => ['isUser'], //isAdmin
                    ],

//                    [
//                        'allow' => true,
//                        'actions' => ['view'],
//                        'roles' => ['viewPost'],
//                    ],

                ],
            ],
        ];
    }

    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();

        // custom initialization code goes here
    }
}
