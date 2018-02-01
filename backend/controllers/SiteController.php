<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use common\models\LoginForm;
use backend\models\ExamForm;
use common\models\Exams;
use frontend\models\UserExam;
use yii\data\Pagination;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'exam', 'exam-confirm', 'exams', 'edit', 'save', 'delete', 'users', 'user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login('back') && Yii::$app->user->identity->isadmin) {
            return $this->goBack();
        } else {
            Yii::$app->session->setFlash('error', 'You are not Admin');
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionExam($many = null) {
        /* routing to the exam view and If $many is set it will show the text fields */
        $model = new ExamForm();
        $exams = Exams::find()->all();
        if (!isset($many)){
            if ($model->load(Yii::$app->request->post())){
                $this->saveExam($this->createExam($model));
                return $this->render('exam-confirm',['model' => $model]);
            } else {
                return $this->render('exam',['model' => $model, 'exams' => $exams]);
            }
        } else {
            return $this->render('exam', ['model' => $model, 'many' => $many]);
        }
    }
    
    public function createExam ($model) {
        /*Polishing the exam object to be saved to the database as a JSON string*/
        $exam = []; $i=1; $a=1;
        foreach ($model->attributes as $key => $test){
            switch ($key) {
                case "title":
                    $exam[$key] = $test;
                    break;
                case "questions":
                    foreach($test as $ques){
                        $exam['exam']['question' . $i]['text'] = $ques;
                        $i++;
                    }
                    break;
                case "answers":
                    foreach($test as $ans){
                        if ($ans != rtrim($ans, "*")){
                            $exam['exam']['question' . ceil($a/4)]['right'] = 'answer' . $a;
                        }
                        $exam['exam']['question' . ceil($a/4)]['answers']['answer' . $a] = rtrim($ans, "*");
                        $a++;
                    }
                    break;    
            }
        }
        return $exam;
    }
    
    public function saveExam ($exam, $id = null) {
        /*Taking the exam final form and saving it to the database*/
        if (isset($id)) {
            $save = Exams::findOne(['id' => $id]);
        } else {
            $save = new Exams();
            $save->user_id = Yii::$app->user->identity['id'];
        }
        $save->exam = Json::encode($exam);
//        var_dump($save->exam);
//            die;
        $save->save() or die($save->getErrors());
    }
    
    public function actionEdit($id) {
        /*If an exam is selected insted of a number of question it will rout to the edit page*/
        $model = new ExamForm();
        $exam = Exams::findOne(['id' => $id]);
         if ($model->load(Yii::$app->request->post())){
                $this->saveExam($this->createExam($model), $id);
                return $this->render('exam-confirm');
        } else {
            return $this->render('edit', ['exam' => $exam, 'id' => $id, 'model' => $model]);
        }
    }
    
    public function actionDelete($id) {
        /*Delete the exam and its results from the databases*/
        $exam = Exams::findOne(['id' => $id]);
        $exam->delete();
        $exam = UserExam::findAll(['exam_id' => $id]);
        foreach($exam as $del) {
            $del->delete();
        }
        
        return $this->render('exam-confirm');
    }
    
    public function actionUsers(){
        $users = \common\models\User::find();
        $count = clone $users;
        $pages = new Pagination(['totalCount' => $count->count(), 'pageSizeLimit' => [1,2]]);
        $models = $users->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        return $this->render('users', ['models' => $models, 'pages' => $pages]);
    }
    
    public function actionUser($id){
        $user = \common\models\User::findOne(['id' => $id]);
        return $this->render('user', ['user' => $user]);
    }
}
