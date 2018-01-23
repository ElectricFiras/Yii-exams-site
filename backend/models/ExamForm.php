<?php

namespace backend\models;

use yii;
use yii\base\Model;

class ExamForm extends Model {
    public $title;
    public $question1;
    public $answer1;
    public $answer2;
    public $answer3;
    public $answer4;
    public $question2;
    public $answer5;
    public $answer6;
    public $answer7;
    public $answer8;
    
    public function rules() {
        return [
            [['title', 'question1','answer1','answer2','answer3','answer4','question2','answer5','answer6','answer7','answer8'], 'required'],
        ];
    }
}