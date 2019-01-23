<?php

namespace app\modules\models\forms;

use yii\base\Model;

class UserCreateForm extends Model
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $role;

    public function rules()
    {
        return [
            ['role', 'required'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\entities\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\entities\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'password' => 'Пароль',
            'email' => 'E-mail',
            'role' => 'Роль',
        ];
    }
}
