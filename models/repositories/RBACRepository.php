<?php
namespace app\models\repositories;

use app\models\entities\User;

class RBACRepository
{
    private $auth;

    public function __construct()
    {
        $this->auth = \Yii::$app->authManager;
    }

    public function assignNewUserRole(User $user, $role)
    {
        if ($role == "admin") {
            $userRole = $this->auth->getRole('admin');
        } else {
            $userRole = $this->auth->getRole('user');
        }
        $this->auth->assign($userRole, $user->getId());
        return true;
    }

    public function updateUserRole(User $user, $role)
    {
        $this->auth->revokeAll($user->getId());
        $this->assignNewUserRole($user,$role);
    }

    public function getUserRole($id)
    {
        if (isset($this->auth->getRolesByUser($id)['admin'])) {
            return "admin";
        }
        if (isset($this->auth->getRolesByUser($id)['user'])) {
            return "user";
        }
        return "Role not Found";
    }
}
