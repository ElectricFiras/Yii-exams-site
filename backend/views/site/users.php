<?php
use yii\widgets\LinkPager;
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

echo "<h1>$this->title</h1>";

foreach ($models as $model) {
    // display $model here\
    
   echo "<a href='http://exam.yii/backend/index.php?r=site%2Fuser&id=" . $model->getAttribute('id') ."'>".$model->getAttribute('first_name').' '. $model->getAttribute('last_name')."</a>" ;
    echo '<br> <br>';
}

// display pagination
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>