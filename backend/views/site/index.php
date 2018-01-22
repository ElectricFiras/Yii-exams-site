<?php

/* @var $this yii\web\View */
use common\models\UsersSessions;
use common\models\User;

$this->title = 'My Yii Application';

$activeUsers = UsersSessions::findAll(['end' => null]);
$regestired = User::findAll(['isadmin' => null]);

?>

<div>
    Active Users : <?= count($activeUsers) ?>
</div>

<div>
    Registered Users: <?= count($regestired) ?>
</div>