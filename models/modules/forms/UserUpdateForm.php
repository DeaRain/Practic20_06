<?php

namespace app\models\modules\forms;

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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at','role'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
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
