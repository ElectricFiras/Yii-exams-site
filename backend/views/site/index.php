<?php

/* @var $this yii\web\View */
use common\models\UsersSessions;
use common\models\User;
use common\models\Exams;
use frontend\models\UserExam;

$this->title = 'My Yii Application';

$activeUsers = UsersSessions::findAll(['end' => 0]);
$regestired = User::findAll(['isadmin' => null]);
$exams = count(Exams::find()->all());
$taken = count(UserExam::find()->all());
$passed = count(UserExam::findAll(['failed' => 0]));
?>
<div class="row">
    <div class="col-xs-2">
        Active Users : <?= count($activeUsers) ?>
        <br>
        Registered Users: <?= count($regestired) ?>
        <br>
        Percentage: <?= (count($activeUsers)/count($regestired))*100 ?>%
    </div>
    <div class="col-xs-2">
        Exams: <?= $exams ?> 
        <br>
        Taken: <?= $taken ?>
        <br>
        Passed: <?= $passed ?>
        <br>
        Percentage: <?= $taken>0 ? round(($passed/$taken)*100) : 0 ?>%
    </div>
</div>