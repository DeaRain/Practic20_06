<?php
namespace app\models\repositories;

use app\models\entities\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function getCleanQuery()
    {
        return User::find();
    }

    public function getAllQuery()
    {
        return User::find()->all();
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

    public function save(User $user)
    {
        if (!$user->save()) {
            throw new ServerErrorHttpException('Saving error.');
        }
        return true;
    }

    public function remove(User $user)
    {
        if (!$user->delete()) {
            throw new ServerErrorHttpException('Deleting error.');
        }
        return true;
    }
}
