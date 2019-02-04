<?php

namespace app\modules\admin\controllers;

use app\modules\models\forms\ArticleForm;
use app\modules\models\services\ArticleGridService;
use app\models\repositories\ArticleRepository;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ArticleController extends Controller
{

    private $articleRepository;
    private $articleGridService;

    public function __construct($id, $module, ArticleRepository $articleRepository, ArticleGridService $articleGridService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->articleRepository = $articleRepository;
        $this->articleGridService = $articleGridService;
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->articleRepository->getQueryWith(['category', 'user']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->articleRepository->findModel($id),
        ]);
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
        $model = $this->articleRepository->findModel($id);
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
        $this->articleGridService->remove($id);
        return $this->redirect(['index']);
    }

}
