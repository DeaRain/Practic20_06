<?php
namespace app\models\services;

use app\models\forms\SignupForm;
use app\models\entities\User;
use Yii;

class SignupService
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
}