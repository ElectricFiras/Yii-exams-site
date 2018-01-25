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
                        'actions' => ['logout', 'index', 'exam', 'exam-confirm'],
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
        $model = new ExamForm();
        if (!isset($many)){
            if ($model->load(Yii::$app->request->post())){
                $this->saveExam($this->createExam($model));
                return $this->render('exam-confirm',['model' => $model]);
            } else {
                return $this->render('exam',['model' => $model]);
            }
        } else {
            return $this->render('exam', ['model' => $model, 'many' => $many]);
        }
    }
    
    public function createExam ($model) {
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
    
    public function saveExam ($exam) {
        $save = new Exams();
        $save->user_id = Yii::$app->user->identity['id'];
        $save->exam = Json::encode($exam);
        $save->save() or die($save->getErrors());
    }
}
