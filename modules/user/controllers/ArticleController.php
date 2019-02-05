<?php

namespace app\modules\user\controllers;

use app\modules\models\forms\ArticleFilterForm;
use app\modules\models\forms\ArticleForm;
use app\modules\models\services\ArticleFilterService;
use app\modules\models\services\ArticleGridService;
use app\modules\models\services\ProfileService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ArticleController extends Controller
{
    private $user;
    private $articleGridService;
    private $profileService;

    public function __construct($id, $module, ArticleGridService $articleGridService, ProfileService $profileService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->user = \Yii::$app->user;
        $this->articleGridService = $articleGridService;
        $this->profileService = $profileService;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($active = false, $onCheck = false)
    {
        $searchModel = new ArticleFilterForm();

        $dataProvider = (new ArticleFilterService())->getSearchProvider(
            $this->user->getId(),
            $searchModel,
            Yii::$app->request->queryParams,
            20
        );

        return $this->render('index', compact(['dataProvider','searchModel']));
    }

    public function actionView($id)
    {
        $article = $this->articleGridService->getUserArticle($id, $this->user->getId());
        if ($article) {
            return $this->render('view', [
                'model' => $article,
            ]);
        } else return $this->redirect(['/user/article']);
    }
    public function actionCreate()
    {
        $form = new ArticleForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($id = $this->articleGridService->create($form)){
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->articleGridService->getUserArticle($id, $this->user->getId());
        $form = $this->articleGridService->EntityToForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($this->articleGridService->update($model,$form)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'article' => $model,
            'form' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->articleGridService->getUserArticle($id, $this->user->getId());
        if($model && $this->articleGridService->removeByEntiti($model)){
            return $this->redirect(['index']);
        }
        return $this->redirect('/user/article');
    }
}
