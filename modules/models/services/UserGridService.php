<?php
namespace app\modules\models\services;

use app\models\entities\User;
use app\models\repositories\ArticleRepository;
use app\models\repositories\UserRepository;
use app\modules\models\forms\UserCreateForm;
use app\modules\models\forms\UserUpdateForm;
use app\models\repositories\RBACRepository;

class UserGridService
{
    public function EntityToForm(User $model)
    {
        $form = new UserUpdateForm();
        $form->id = $model->id;
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

    public function create(UserCreateForm $form)
    {
        $user = User::create($form->username,
            $form->email,
            $form->password);

        if ((new UserRepository())->save($user) && (new RBACRepository())->assignNewUserRole($user, $form->role)) {
            return $user->id;
        }

        return false;
    }

    public function update(User $user, UserUpdateForm $form)
    {
        if($form->password_reset_token == "") $form->password_reset_token = null;
        $user->edit($form->username,
            $form->auth_key,
            $form->email,
            $form->password_hash,
            $form->password_reset_token,
            $form->status,
            $form->created_at
            );

        (new UserRepository())->save($user);
        (new RBACRepository())->updateUserRole($user, $form->role);

        return true;
    }
}
