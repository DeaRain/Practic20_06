<?php

namespace app\models\modules\forms;

use Yii;
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
            [['username', 'password', 'email', 'role'], 'required'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
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
            'password' => 'Пароль',
            'email' => 'E-mail',
            'role' => 'Роль',
        ];
    }

}
