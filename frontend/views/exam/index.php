<?php
/* @var $this yii\web\View */

use yii\helpers\Json;
?>
<h1>exam/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php foreach ($exams->all() as $exam) { ?>
<a href="http://exam.yii/index.php?r=exam%2Fexam&id=<?=$exam->getAttribute('id')?>"> <?= Json::decode($exam->getAttribute('exam'))['title'] ?> </a>
<br>
<?php } ?>
