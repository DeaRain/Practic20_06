<?php
namespace app\models\services;

use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use Yii;

class AuthService
{
    public function signupWithRBAC(SignupForm $form, $userType)
    {
        if($user =  $this->signup($form)){
            $this->regInRBAC($user, $userType);
            return $user;
        }
        return null;
    }

    public function signup(SignupForm $form)
    {
        $user = User::create($form->username, $form->email, $form->password);
        return $user->save() ? $user : null;
    }

    public function regInRBAC(User $user, $userType)
    {
        $auth = Yii::$app->authManager;
        if($userType=="admin") {
            $userRole = $auth->getRole('admin');
        } else {
            $userRole = $auth->getRole('user');
        }
        $auth->assign($userRole, $user->getId());
    }

    public function login(LoginForm $form)
    {
        if ($form->validate()) {
            return Yii::$app->user->login($this->getUser($form->username), $form->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function validatePassword(LoginForm $form)
    {
        if (!$form->hasErrors()) {
            $user = $this->getUser($form->username);
            if (!$user || !$user->validatePassword($form->password)) {
                return ('Incorrect username or password.');
            }
        }
        return null;
    }

    protected function getUser($username)
    {
        return User::findByUsername($username);
    }
}