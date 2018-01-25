<?php

namespace frontend\controllers;

use common\models\Exams;
use frontend\models\UserExam;
use Yii;
use yii\helpers\Json;
use yii\i18n\Formatter;


class ExamController extends \yii\web\Controller
{
        
    public function actionIndex()
    {
        $exams = Exams::find();
        return $this->render('index', ['exams' => $exams]);
    }
    
    public function actionExam($id) {
        $model = new UserExam();
        $exam = Exams::findOne(['id' => $id]);
        $formate = new Formatter();
        $model->user_id = Yii::$app->user->getId();
        $model->exam_id = $id;
        if ($model->load(Yii::$app->request->post())){
            $mark = $this->getResult($model, $exam);
            return $this->render('result', ['mark' => $mark]);    
        } else {
        return $this->render('exam', ['exam' => $exam, 'model' => $model]);
        }
    
    }
    
    public function getResult ($model, $exam) {
        $formate = new Formatter();
        $model->end = (int)$formate->asTimestamp(date("Y-m-d H:i:s"));
        $mark = 0;
        $teest = Json::decode($exam->getAttribute('exam'));
        foreach($model->getAttribute('answers') as $key => $test){
            if ($teest['exam']['question' . $key]['right'] == $test){
                $mark++;
            }
        }
        $model->mark = $mark;
        $model->answers = Json::encode($model->answers);
        $model->save();
        return $mark;
    }

}
