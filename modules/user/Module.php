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
}
