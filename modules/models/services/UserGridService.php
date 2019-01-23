<?php
namespace app\modules\models\services;

use app\models\entities\User;
use app\modules\models\forms\UserCreateForm;
use app\modules\models\forms\UserUpdateForm;
use app\models\repositories\RBACRepository;

class UserGridService
{
    public function EntityToForm(User $model)
    {
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

    public function save(UserCreateForm $form)
    {
        $user = User::create($form->username,
            $form->email,
            $form->password);

        $result = $user->save();
        $form->id = $user->id;
        (new RBACRepository())->assignNewUserRole($user, $form->role);
       return $result;
    }

    public function update(User $model, UserUpdateForm $form)
    {
        $model->username = $form->username;
        $model->auth_key = $form->auth_key;
        $model->password_hash = $form->password_hash;
        if($form->password_reset_token == "") $form->password_reset_token = null;
        $model->password_reset_token = $form->password_reset_token;
        $model->email = $form->email;
        $model->status = $form->status;
        $model->created_at = $form->created_at;
        $model->updated_at = time();

        (new RBACRepository())->updateUserRole($model, $form->role);

        return $model->save();
    }
}
