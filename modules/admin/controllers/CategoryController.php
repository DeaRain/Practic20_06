<?php

namespace app\modules\admin\controllers;

use app\models\repositories\CategoryRepository;
use app\modules\models\forms\CategoryForm;
use app\modules\models\services\CategoryGridService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class CategoryController extends Controller
{
    private $categoryGridService;

    public function __construct($id, $module, CategoryGridService $categoryGridService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryGridService = $categoryGridService;
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
            'query' => (new CategoryRepository())->getCleanQuery(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => (new CategoryRepository())->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $form = new CategoryForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($id = $this->categoryGridService->create($form)){
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->render('create', [
            'form' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = (new CategoryRepository())->findModel($id);
        $form = $this->categoryGridService->EntityToForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($this->categoryGridService->update($model, $form)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'category' => $model,
            'form' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        $this->categoryGridService->remove($id);
        return $this->redirect(['index']);
    }
}
