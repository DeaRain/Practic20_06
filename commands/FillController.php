<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\entities\Article;
use app\models\entities\Category;
use Yii;
use app\models\entities\User;

class FillController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        if(!$auth->getRole('user')) {
            $user = $auth->createRole('user');
            $admin = $auth->createRole('admin');
            $auth->add($user);
            $auth->add($admin);
            $isAdmin = $auth->createPermission('isAdmin');
            $isAdmin->description = 'Be a Admin';
            $auth->add($isAdmin);
            $isUser = $auth->createPermission('isUser');
            $isUser->description = 'Be a User';
            $auth->add($isUser);
            $auth->addChild($user, $isUser);
            $auth->addChild($admin, $isAdmin);
            $auth->addChild($admin, $user);
            echo "RBAC Roles added" . "\n";
        }
        function createUser($username,$mail,$password,$role){
            $user = new User();
            $user->username = $username;
            $user->email = $mail;
            $user->setPassword($password);
            $user->generateAuthKey();
            $user->save(false);
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole($role);
            $auth->assign($userRole, $user->getId());
            echo $role." with username: {$user->username} and password: {$password} has been created" . "\n";
        }
        createUser("admin","admin@gmail.com","qwerty","admin");
        createUser("user1","user@gmail.com","user123","user");
        createUser("newplayer","player@gmail.com","qwerty","user");
        createUser("noname","noname@gmail.com","qwerty123","user");
        createUser("alive","alive@gmail.com","qwerty111","user");

        $content = 'Не следует, однако, забывать о том, что повышение уровня гражданского сознания
        требует от нас анализа системы масштабного изменения ряда параметров! Соображения
        высшего порядка, а также постоянный количественный рост и сфера нашей активности обеспечивает 
        широкому кругу специалистов участие в формировании модели развития! Соображения высшего порядка,
        а также реализация намеченного плана развития позволяет выполнить важнейшие задания по разработке 
        дальнейших направлений развития проекта.';

        for ($i = 1;$i<51;$i++){
            $cat = new Category();
            $cat->name='Категория: ' . $i;
            $cat->descr=$content;
            $cat->save();
        }

        for ($k = 0;$k<15;$k++){
            $art = new Article();
            $art->category_id=1;
            $art->name='Статья для первой категории: ' . $k;
            $art->content=$content;
            $art->author=rand(1,5);
            $art->status=rand(0,1);
            $art->photo='default.jpg';
            $art->save();
        }
        for ($i = 2;$i<50;$i++){
            for ($k = 0;$k<4;$k++){
                $art = new Article();
                $art->category_id=$i;
                $art->name='Статья: '.$i;
                $art->content=$content;
                $art->author=rand(1,5);
                $art->status=rand(0,1);
                $art->photo='default1.jpg';
                $art->save();
            }
        }
        echo "Fill Accept"."\n";
        return ExitCode::OK;
    }
}
