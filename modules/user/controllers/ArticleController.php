<?php

namespace app\modules\user\controllers;
use app\components\PhotoStorage;
use app\models\forms\ArticleForm;
use app\models\modules\services\ArticleGridService;
use app\models\modules\services\ProfileService;
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

    public function actionIndex($active=false,$onCheck=false)
    {
        $queryFilter = $this->articleGridService->getQueryFilter($this->user->getId(),$active,$onCheck);
        $dataProvider = new ActiveDataProvider([
            'query' => (new ArticleRepository())->getQueryWithAndWhere(["category"],$queryFilter),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', compact(['dataProvider','active','onCheck','$searchModel']));
    }

    public function actionView($id)
    {
        $article = $this->articleGridService->getUserArticle($id, $this->user->getId());
        if ($article){
            return $this->render('view', [
                'model' => $article,
            ]);
        } else return $this->redirect(['/user/article']);

    }

    public function actionCreate()
    {
        $form = new ArticleForm();
        if ($form->load(Yii::$app->request->post())) {
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');

            if ($this->articleGridService->save($form)){
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->articleGridService->getUserArticle($id,$this->user->getId());
        if($model){
            $form = $this->articleGridService->EntityToForm($model);
            if(Yii::$app->request->isPost) {
                if ($form->load(Yii::$app->request->post())) {
                    $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
                    if ($this->articleGridService->update($model,$form)) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            return $this->render('update', [
                'model' => $form,
            ]);
        } else {
            return $this->redirect('/user/article');
        }

    }

    public function actionDelete($id)
    {
        $model = $this->articleGridService->getUserArticle($id,$this->user->getId());
        if($model){
            $model->delete();
            return $this->redirect(['index']);
        } else return $this->redirect('/user/article');

    }
}
