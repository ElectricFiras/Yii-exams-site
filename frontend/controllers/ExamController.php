<?php

namespace frontend\controllers;

use common\models\Exams;
use Yii;
use yii\helpers\Json;

class ExamController extends \yii\web\Controller
{
        
    public function actionIndex()
    {
        $exams = Exams::find();
        return $this->render('index', ['exams' => $exams]);
    }
    
    public function actionExam($id) {
        $model = new Exams();
        $exam = Exams::findOne(['id' => $id]);
        return $this->render('exam', ['exam' => $exam, 'model' => $model]);
    }

}
