<?php

namespace app\modules\models\forms;

use Yii;
use yii\base\Model;

class UserUpdateForm extends Model
{
    public $id;
    public $username;
    public $auth_key;
    public $password_hash;
    public $password_reset_token;
    public $email;
    public $status;
    public $created_at;
    public $updated_at;
    public $role;

    public function rules()
    {
        return [
            [['password_hash', 'email', 'created_at'], 'required'],
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
            [['auth_key'], 'string', 'max' => 32],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'auth_key' => 'Ключ авторизации',
            'password_hash' => 'Хэш пароля',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'E-mail',
            'status' => 'Статус',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Updated At',
            'role' => 'Роль',
        ];
    }

}
