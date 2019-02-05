<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\repositories\ArticleRepository;
use app\models\repositories\CategoryRepository;
use app\models\services\AuthService;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\entities\Article;
use app\models\entities\Category;
use Yii;

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

        $aSer = new AuthService();
        $aSer->createNewUserWithRBAC("admin","admin@gmail.com","qwerty",'admin');
        $aSer->createNewUserWithRBAC("user1","user@gmail.com","user123","user");
        $aSer->createNewUserWithRBAC("newplayer","player@gmail.com","qwerty","user");
        $aSer->createNewUserWithRBAC("noname","noname@gmail.com","qwerty123","user");
        $aSer->createNewUserWithRBAC("alive","alive@gmail.com","qwerty111","user");

        $content = 'Не следует, однако, забывать о том, что повышение уровня гражданского сознания
        требует от нас анализа системы масштабного изменения ряда параметров! Соображения
        высшего порядка, а также постоянный количественный рост и сфера нашей активности обеспечивает 
        широкому кругу специалистов участие в формировании модели развития! Соображения высшего порядка,
        а также реализация намеченного плана развития позволяет выполнить важнейшие задания по разработке 
        дальнейших направлений развития проекта.';

        $catRep = new CategoryRepository();
        $artRep = new ArticleRepository();

        for ($i = 1; $i < 51; $i++) {
            $category = Category::create('Категория: ' . $i, $content);
            $catRep->save($category);

            for ($k = 1; $k < 5; $k++) {
                $article = Article::create($i,'Статья: ' . $i . ':' . $k, $content, rand(1,5), rand(0,1));
                $artRep->save($article);
            }
        }

        echo "Fill Accept"."\n";
        return ExitCode::OK;
    }
}