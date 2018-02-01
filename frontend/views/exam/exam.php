<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\Exams */
/* @var $form ActiveForm */

$test = Json::decode($exam->getAttribute('exam'));
$x = 1;

$this->title = 'Take Exam';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-views-exam-exam">
    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php $form = ActiveForm::begin(); ?>
    <?php foreach ($test['exam'] as $question) {?>
    <p> <?=$question['text']?> </p>
    
    <?php 
        $answers = [];
    ?>
    <?= $form->field($model, "answers[$x]")->radioList($question['answers'])->label(''); ?>
    <?php $x++;} ?>
    <div>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end() ?>
</div>