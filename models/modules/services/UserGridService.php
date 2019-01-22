<?php
namespace app\models\modules\services;

use app\models\entities\Article;
use app\models\forms\ArticleForm;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\entities\User;
use app\models\modules\forms\UserCreateForm;
use app\models\modules\forms\UserForm;
use app\models\modules\forms\UserUpdateForm;
use app\models\repositories\RBACRepository;
use app\models\services\AuthService;
use Yii;
use yii\data\ActiveDataProvider;

class UserGridService
{
    public function getQueryFilter($authorId, $active, $onCheck)
    {
        $queryFilter = ['author'=>$authorId];
        if($active=="ok"&&$onCheck=="ok") {
        } elseif ($active=="ok") {
            $queryFilter = ['status'=>1,'author'=>$authorId];
        } elseif ($onCheck=="ok") {
            $queryFilter = ['status'=>0,'author'=>$authorId];
        }
        return $queryFilter;
    }

    public function getDataProvider($queryFilter, $pageSize = 20)
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->with('category')->where($queryFilter),
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
    }

    public function EntityToForm(User $model){
        $form = new UserUpdateForm();
        $form->username = $model->username;
        $form->auth_key = $model->auth_key;
        $form->password_hash = $model->password_hash;
        $form->password_reset_token = $model->password_reset_token;
        $form->email = $model->email;
        $form->status = $model->status;
        $form->created_at = $model->created_at;
        $form->created_at = $model->updated_at;
        $form->role = (new RBACRepository())->getUserRole($model->id);
        return $form;
    }

    public function save(UserCreateForm $form){

        $user = User::create($form->username,
            $form->email,
            $form->password);

        $result = $user->save();

        (new RBACRepository())->assignNewUserRole($user, $form->role);

       return $result;
    }

    public function update(User $model,UserUpdateForm $form){

        $model->username = $form->username;
        $model->auth_key = $form->auth_key;
        $model->password_hash = $form->password_hash;
        if($form->password_reset_token == "") $form->password_reset_token = null;
        $model->password_reset_token = $form->password_reset_token;
        $model->email = $form->email;
        $model->status = $form->status;
        $model->created_at = $form->created_at;
        $model->created_at = $form->updated_at;

        (new RBACRepository())->updateUserRole($model, $form->role);

        return $model->save();
    }

}