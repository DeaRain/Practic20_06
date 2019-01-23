<?php
namespace app\modules\models\services;

use app\models\entities\User;
use app\models\repositories\UserRepository;
use yii\base\Action;

class ProfileService
{
    public function isBanPageAction(Action $action)
    {
        if ($action->controller->id == "profile" && $action->id == "banned") {
            return 1;
        } else {
            return 0;
        }
    }

    public function isBannedById($id)
    {
        return $this->isBanned((new UserRepository())->findModel($id));
    }

    public function isBanned(User $user)
    {
        if ($user->status == 1) {
            return 1;
        }
        return 0;
    }

    public function userStatus(User $user)
    {
        switch ($user->status) {
            case 1:
                return "Заблокирован";
                break;
            case 10:
                return "Активный";
                break;
            default:
                return $user->status;
                break;
        }
    }
}