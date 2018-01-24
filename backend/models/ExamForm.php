<?php

namespace backend\models;

use yii;
use yii\base\Model;

class ExamForm extends Model {
    public $title;
    public $questions = [];
    public $answers = [];
    
    public function rules() {
        return [
            [['questions','title','answers'], 'required'],
        ];
    }
}