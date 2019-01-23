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
        if ($form->load(Yii::$app->request->post())) {
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');

            if ($form->validate() && $this->categoryGridService->save($form)){
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = (new CategoryRepository())->findModel($id);
        $form = $this->categoryGridService->EntityToForm($model);
        if(Yii::$app->request->isPost) {
            if ($form->load(Yii::$app->request->post())) {
                $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
                if ($form->validate() && $this->categoryGridService->update($model,$form)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        (new CategoryRepository())->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
