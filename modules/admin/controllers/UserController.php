<?php

namespace app\modules\admin\controllers;

use app\models\entities\User;
use app\models\modules\forms\UserCreateForm;
use app\models\modules\forms\UserForm;
use app\models\modules\forms\UserUpdateForm;
use app\models\modules\services\UserGridService;
use app\models\repositories\RBACRepository;
use app\models\repositories\UserRepository;
use Yii;
use app\models\ModuleUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */

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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => $this->userRepository->getCleanQuery()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->userRepository->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new UserCreateForm();

        if ($form->load(Yii::$app->request->post()) && $this->userGridService->save($form)) {
            return $this->redirect(['view', 'id' => $form->id]);
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->userRepository->findModel($id);
        $form = $this->userGridService->EntityToForm($model);
        if ($form->load(Yii::$app->request->post())) {
            if ($this->userGridService->update($model, $form)) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                echo "123";die;
            }
        }
        return $this->render('update', [
            'model' => $form,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->userRepository->findModel($id)->delete();

        return $this->redirect(['index']);
    }

}
