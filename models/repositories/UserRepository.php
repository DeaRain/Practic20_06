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

}