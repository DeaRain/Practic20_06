<?php
namespace app\models\repositories;

use app\models\entities\User;

class UserRepository
{
    public function getProfileInfo($id)
    {
        $thisUser = $this->findById($id);
        $user = [
            'name'=>$thisUser->username,
            'banned'=>$this->isBanned($thisUser)
        ];
        return $user;
    }

    public function findById($id)
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
        return $this->isBanned($this->findById($id));
    }
}