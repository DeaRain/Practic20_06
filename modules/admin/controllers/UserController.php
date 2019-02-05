<?php

namespace app\modules\admin\controllers;

use app\modules\models\forms\UserCreateForm;
use app\modules\models\services\UserGridService;
use app\models\repositories\UserRepository;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;

class UserController extends Controller
{
    private $userRepository;
    private $userGridService;

    public function __construct($id, $module, UserRepository $userRepository, UserGridService $userGridService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userRepository = $userRepository;
        $this->userGridService = $userGridService;
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
            'query' => $this->userRepository->getCleanQuery()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->userRepository->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $form = new UserCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($id = $this->userGridService->create($form)) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->userRepository->findModel($id);
        $form = $this->userGridService->EntityToForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($this->userGridService->update($model, $form)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        $this->userRepository->findModel($id)->delete();
        return $this->redirect(['index']);
    }

}
