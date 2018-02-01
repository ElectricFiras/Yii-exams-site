<?php
$this->title = $user->getAttribute('username');
$this->params['breadcrumbs'][] = $this->title;
?>

<h4><strong>First & Last name:</strong> <?=$user->getAttribute('first_name') . ' ' . $user->getAttribute('last_name')?></h4> 
<h4><strong>Email:</strong> <?=$user->getAttribute('email')?>
<h4><strong>Phone:</strong> <?=$user->getAttribute('phone')?>
<h4><strong>age:</strong> <?=$user->getAttribute('age')?>
<h4><strong>Gender:</strong> <?=$user->getAttribute('gender')==0 ? 'Male' : 'Female'?>
