<?php

namespace app\modules\user;

use app\models\modules\services\ProfileService;
use yii\filters\AccessControl;


/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['isUser'],
                    ],
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

    public function beforeAction($action)
    {
        if((new ProfileService())->isBannedById($this->user->getId())) {
            if(!(new ProfileService())->isBanAction($action)) {
                return \Yii::$app->response->redirect(['/user/profile/banned']);
            }
        } elseif((new ProfileService())->isBanAction($action)) {
            return \Yii::$app->response->redirect(['/user/profile/index']);
        }
        return parent::beforeAction($action);
    }
}
