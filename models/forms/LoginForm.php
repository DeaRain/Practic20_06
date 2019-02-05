<?php
namespace app\models\forms;

use app\models\services\AuthService;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if ($error = (new AuthService())->validatePassword($this)) {
            $this->addError($attribute, $error);
        }
    }
}
