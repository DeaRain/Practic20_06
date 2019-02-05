<?php
namespace app\models\services;

use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use app\models\repositories\RBACRepository;
use app\models\repositories\UserRepository;
use Yii;

class AuthService
{
    public function signupWithRBAC(SignupForm $form, $userType)
    {
        if ($user = $this->createNewUser($form->username, $form->email, $form->password)) {
            (new RBACRepository())->assignNewUserRole($user, $userType);
            return $user;
        }
        return null;
    }

    public function createNewUserWithRBAC($username, $email, $password, $userType)
    {
        if ($user = $this->createNewUser($username, $email, $password)) {
            (new RBACRepository())->assignNewUserRole($user, $userType);
            return $user;
        }
        return null;
    }

    public function createNewUser($username, $email, $password)
    {
        $user = User::create($username, $email, $password);
        return $user->save() ? $user : null;
    }

    public function login(LoginForm $form)
    {
        if ($form->validate()) {
            return Yii::$app->user->login((new UserRepository())->findModelByName($form->username), $form->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function validatePassword(LoginForm $form)
    {
        if (!$form->hasErrors()) {
            $user = (new UserRepository())->findModelByName($form->username);
            if (!$user || !$user->validatePassword($form->password)) {
                return ('Incorrect username or password.');
            }
        }
        return null;
    }
}
