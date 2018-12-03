<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['register','logout'],
                'rules' => [
                    [
                        'actions' => ['register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister($userType="user")
    {
        $regmodel = new RegisterForm();
        if ($regmodel->load(Yii::$app->request->post()) && $regmodel->validate()) {
            if (RegisterForm::find()->where(['username'=>$regmodel->username])->exists()) {
                $result = 'Пользователь с таким именем существует';
                return $this->render('register', compact('regmodel', 'result'));
            }
            if ($regmodel->validate()) {
                $result = 'Регистрация прошла успешно!';
                $user = new User();
                $user->username = $regmodel->username;
                $user->setPassword($regmodel->password);
                $user->save(false);
                $auth = Yii::$app->authManager;
                if($userType=="admin") $userRole = $auth->getRole('admin');
                else $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->getId());
                $regmodel=new RegisterForm();
                return $this->render('register', compact('regmodel', 'result'));
            } else {
                $result = 'Ошибка при регистрации!';
                return $this->render('register', compact('regmodel', 'result'));
            }
        } else {
            return $this->render('register', compact('regmodel'));
        }
    }
}
