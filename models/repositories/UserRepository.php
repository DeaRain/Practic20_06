<?php
namespace app\models\repositories;

use app\models\entities\User;
use yii\web\NotFoundHttpException;

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

    public function getCleanQuery()
    {
        return User::find();
    }

    public function findById($id)
    {
        return User::findIdentity($id);
    }

    public function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('User not found.');
    }

    public function findModelByName($username)
    {
        if (($model = User::findOne(['username' => $username])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('User not found.');
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