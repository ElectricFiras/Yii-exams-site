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
    
    public function actionExam() {
        $model = new ExamForm();
        $save = new Exams();
        if ($model->load(Yii::$app->request->post())){
            $exam = [];
            foreach ($model->attributes as $key => $test){
                if ($key == 'title'){
                    $exam[$key] = $test;
                }elseif (substr($key, 0, -1) == 'question'){
                    $exam['exam'][$key]['text'] = $test;
                }elseif (substr($key, 0, -1) == 'answer'){
                    $index = (int)substr($key, -1);
                    $exam['exam']['question' . ceil($index/4)]['answers'][$key] = $test;
                }
                $save->user_id = Yii::$app->user->identity['id'];
                $save->exam = Json::encode($exam);
                $save->save();
            }
            return $this->render('exam-confirm',['model' => $model]);
        } else {
            return $this->render('exam',['model' => $model]);
        }
    }
}
