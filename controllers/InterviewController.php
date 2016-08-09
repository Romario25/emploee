<?php

namespace app\controllers;

use app\forms\InterviewEditForm;
use app\forms\InterviewJoinForm;
use app\forms\InterviewRejectForm;
use app\services\StaffService;
use Yii;
use app\models\Interview;
use app\models\InterviewSearch;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InterviewController implements the CRUD actions for Interview model.
 */
class InterviewController extends Controller
{

    private $staffService;

    public function __construct($id, Module $module, StaffService $staffService, array $config = [])
    {
        $this->staffService = $staffService;
        parent::__construct($id, $module, $config = []);
    }


    /**
     * @inheritdoc
     */
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
     * Lists all Interview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InterviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Interview model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Interview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Interview();
        $model->scenario = Interview::SCENARIO_CREATE;
        $model->date = date("Y-m-d");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Пригласить на интервью
     */
    public function actionJoin(){
        $form = new InterviewJoinForm();

        if($form->load(Yii::$app->request->post()) && $form->validate()){
            // Внедение зависимостей
            // 1 вариант
           // $service = Yii::$container->get(StaffService::class);

            // 2 вариант
            // $service = Yii::createObject(StaffService::class);

            // 3 вариант. Переопределение конструктора

            $interview = $this->staffService->joinToInterview($form->lastName, $form->firstName, $form->email, $form->date);

            return $this->redirect(['view', 'id'=>$interview->id]);
        } else {
            return $this->render('join', ['joinForm' => $form]);
        }

    }

    /**
     * Updates an existing Interview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $interview = $this->findModel($id);
        $form = new InterviewEditForm($interview);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $model = $this->staffService->editInterview($id, $form->lastName, $form->firstName, $form->email, $form->date);
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'updateForm' => $form,
            ]);
        }
    }
    
    public function actionReject($id){
        $interview = Interview::findOne($id);
        if($interview == null)throw new \InvalidArgumentException();
        
        $form = new InterviewRejectForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate()){

            $this->staffService->rejectInterview($id, $form->reason);
            return $this->redirect('index');
        }
        
        return $this->render('reject', ['rejectForm' => $form]);
    }

    /**
     * Deletes an existing Interview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Interview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Interview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Interview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
