<?php
/* @var $this yii\web\View */

use yii\helpers\Json;
use yii\helpers\Html;
$exams_id = [];

foreach ($taken as $took) {
    $exams_id[$took->getAttribute('exam_id')] = $took->getAttribute('mark');
}
$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<br>
<hr>
<hr>

<?php foreach ($exams->all() as $exam) { ?>
    <?php if (!key_exists($exam->getAttribute('id'), $exams_id)) {?>
        <a href="http://exam.yii/index.php?r=exam%2Fexam&id=<?=$exam->getAttribute('id')?>"> <?= Json::decode($exam->getAttribute('exam'))['title'] ?> </a>
        <br>
        <p>You didn't take this exam yet</p>
        <hr>
        <hr>
    <?php } else { ?>
        <?= Json::decode($exam->getAttribute('exam'))['title'] ?>
        <br>
        <p> you scored in the exam : <strong><?= $exams_id[$exam->getAttribute('id')] ?></strong></p>
        <hr>
        <hr>
    <?php } ?>
<?php } ?>
