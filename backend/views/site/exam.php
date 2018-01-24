<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php if (!isset($many)) { ?>

<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">How mane Questions ?
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="http://exam.yii/backend/index.php?r=site%2Fexam&many=5">5</a></li>
    <li><a href="http://exam.yii/backend/index.php?r=site%2Fexam&many=10">10</a></li>
    <li><a href="http://exam.yii/backend/index.php?r=site%2Fexam&many=15">15</a></li>
  </ul>
</div>
<?php }else { ?>
<?php $totAns = $many*4 ?>
<?php $form = ActiveForm::begin(['action' => '/backend/index.php?r=site%2Fexam']); ?>

    <?= $form->field($model, 'title') ?>
<p> <h3  style='color: red;'>For the right answer just put the ' * ' symbol at the end of its text ...</h3></p>

<?php for ($i=0; $i < $many; $i++) {?>
    <?= $form->field($model, 'questions[]')->label('Question '.($i+1))->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'answers[]')->label('Answer 1') ?>
    <?= $form->field($model, 'answers[]')->label('Answer 2') ?>
    <?= $form->field($model, 'answers[]')->label('Answer 3') ?>
    <?= $form->field($model, 'answers[]')->label('Answer 4') ?>
<br>
<hr style="border-bottom: solid;">
        <?php } ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php } ?>