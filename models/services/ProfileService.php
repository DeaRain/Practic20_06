<?php
namespace app\models\services;

use app\models\entities\User;

class ProfileService
{
    public function getProfileInfo($id)
    {
        $thisUser = $this->getUserById($id);
        $user = [
            'name'=>$thisUser->username,
            'banned'=>$this->isBanned($thisUser)
        ];
        return $user;
    }

    public function getUserById($id)
    {
        return User::findIdentity($id);
    }


    public function isBanned(User $user)
    {
        if($user->status==1) {
            return 1;
        }
        return 0;
    }

    public function isBannedById($id)
    {
        return $this->isBanned($this->getUserById($id));
    }
}