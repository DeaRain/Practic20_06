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

/**
 * ArticleController implements the CRUD actions for Article model.
 */
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

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->articleRepository->getQueryWith(['category', 'user']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->articleRepository->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ArticleForm();
        if ($form->load(Yii::$app->request->post())) {
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if ($form->validate() && $this->articleGridService->save($form)){
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->articleRepository->findModel($id);
        if($model){
            $form = $this->articleGridService->EntityToForm($model);
            if(Yii::$app->request->isPost) {
                if ($form->load(Yii::$app->request->post())) {
                    $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
                    if ($form->validate() && $this->articleGridService->update($model,$form)) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            return $this->render('update', [
                'model' => $form,
            ]);
        } else {
            return $this->redirect('/admin/article');
        }
    }

    public function actionDelete($id)
    {
        $this->articleRepository->findModel($id)->delete();

        return $this->redirect(['index']);
    }

}
