<?php
namespace app\models\modules\services;

use app\models\entities\User;
use yii\base\Action;

class ProfileService
{
    public function isBanAction(Action $action)
    {
        if($action->controller->id=="profile" && $action->id=="banned") return 1;
        else return 0;
    }

    public function isBannedById($id)
    {
        return $this->isBanned($this->getUserById($id));
    }

    public function isBanned(User $user)
    {
        if($user->status==1) {
            return 1;
        }
        return 0;
    }

    public function getUserById($id)
    {
        return User::findIdentity($id);
    }




}