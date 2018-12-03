<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Article;
use app\models\Category;
use Yii;
use app\models\User;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FillController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {

        for ($k = 0;$k<15;$k++){
            $art = new Article();
            $art->category_id=1;
            $art->name='Статья для первой категории: ' . $k;

            $art->content='Не следует, однако, забывать о том, что повышение уровня гражданского сознания требует от нас анализа системы масштабного изменения ряда параметров! Соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу специалистов участие в формировании модели развития! Соображения высшего порядка, а также реализация намеченного плана развития позволяет выполнить важнейшие задания по разработке дальнейших направлений развития проекта.';
            $art->author=rand(1,5);
            $art->status=rand(0,1);
            $art->save();
        }
        for ($i = 2;$i<50;$i++){
            for ($k = 0;$k<4;$k++){
                $art = new Article();
                $art->category_id=$i;
                $art->name='Статья: ' . $i;
                $art->content='Не следует, однако, забывать о том, что повышение уровня гражданского сознания требует от нас анализа системы масштабного изменения ряда параметров! Соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу специалистов участие в формировании модели развития! Соображения высшего порядка, а также реализация намеченного плана развития позволяет выполнить важнейшие задания по разработке дальнейших направлений развития проекта.';
                $art->author=rand(1,5);
                $art->status=rand(0,1);
                $art->save();
            }
        }
        for ($i = 1;$i<51;$i++){
            $cat = new Category();
            $cat->name='Категория: ' . $i;
            $cat->descr='Не следует, однако, забывать о том, что повышение уровня гражданского сознания требует от нас анализа системы масштабного изменения ряда параметров! Соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу специалистов участие в формировании модели развития! Соображения высшего порядка, а также реализация намеченного плана развития позволяет выполнить важнейшие задания по разработке дальнейших направлений развития проекта.';
            $cat->save();
        }


        echo "Fill Accept" . "\n";

        $auth = Yii::$app->authManager;
        //  добавляем разрешение "isAdmin'"
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


            $user = new User();
            $user->username ="ADMIN";
            $user->setPassword("12345");
            $user->save(false);

            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('admin');
            $auth->assign($userRole, $user->getId());
            echo "Admin with username: {$user->username} and password: {$user->password} has been created" . "\n";



        $user = new User();
        $user->username ="USER";
        $user->setPassword("12345");
        $user->save(false);

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        $auth->assign($userRole, $user->getId());
        echo "User with username: {$user->username} and password: {$user->password} has been created" . "\n";


        for ($i=0;$i<3;$i++){
            $user = new User();
            $user->username =Yii::$app->security->generateRandomString(5);
            $user->setPassword(Yii::$app->security->generateRandomString(5));
            $user->save(false);

            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($userRole, $user->getId());
            echo "User with username: {$user->username} and password: {$user->password} has been created" . "\n";
        }
        return ExitCode::OK;
    }
}
