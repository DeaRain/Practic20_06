<?php
/**
 * Created by PhpStorm.
 * User: Asscy
 * Date: 30.10.2018
 * Time: 23:38
 */

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class RegisterForm extends ActiveRecord
{
    public static $username;
    public static $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'trim'],
        ];
    }
    public static function tableName()
    {
        return 'user';
    }
}
