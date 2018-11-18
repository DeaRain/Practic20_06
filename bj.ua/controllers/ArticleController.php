<?php
namespace app\controllers;
use app\models\Category;
use app\models\RegisterForm;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Article;
use Yii;
use app\models\User;
class ArticleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAll($id=Null)
    {
        if(!$id) return $this->redirect('/');
        $category = Category::find()->where(['id'=>$id])->limit(1)->one();
        $query = Article::find()->where(['category_id'=>$id,'status'=>'1']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $articles = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('all',compact('articles','category','pages'));



        $articles = Article::find()->where(['category_id'=>$id,'status'=>'1'])->asArray()->all();

    }
    public function actionView($id)
    {
        $article = Article::find()->where(['id'=>$id])->limit(1)->one();
        return $this->render('view',compact('article'));
    }
    public function actionTest()
    {

//        $auth = Yii::$app->authManager;
        // добавляем разрешение "isAdmin'"
//        $isAdmin' = $auth->createPermission('isAdmin');
//        $isAdmin'->description = 'Be a Admin';
//        $auth->add($isAdmin');
//
//        $isUser = $auth->createPermission('isUser');
//        $isUser->description = 'Be a User';
//        $auth->add($updatePost);
//
//        $user = $auth->getRole('user');
//        $auth->addChild($user, $updatePost);
//        $admin = $auth->getRole('admin');
//        $auth->addChild($admin, $createPost);
//        $auth->addChild($admin, $author);
       // return print_r(Yii::$app->user);
        //$auth = Yii::$app->authManager;
//        return Yii::$app->user->can('isUser');
//        return print_r ($auth->getRolesByUser(Yii::$app->user->getId()));
//        return '<pre>'.print_r(Yii::$app->user,true).'</pre>';
        return 1;
    }
    public function actionRegister()
    {

        $regmodel = new RegisterForm();

        if ($regmodel->load(Yii::$app->request->post()) && $regmodel->validate()) {
            if (RegisterForm::find()->where(['username'=>$regmodel->username])->exists()) {
                $result = 'Пользователь с таким именем существует';
                return $this->render('register', compact('regmodel', 'result'));
            }

            if ($regmodel->validate()) {
                $result = 'Регистрация прошла успешно!';

                $user = new User();
                $user->username = $regmodel->username;
                $user->setPassword($regmodel->password);
                $user->save(false);

                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->getId());


                $regmodel=new RegisterForm();
                return $this->render('register', compact('regmodel', 'result'));
            } else {
                $result = 'Ошибка при регистрации!';
                return $this->render('register', compact('regmodel', 'result'));
            }
        }
        else {
            return $this->render('register', compact('regmodel'));
        }
    }
}