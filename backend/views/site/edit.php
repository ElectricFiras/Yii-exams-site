<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

$data = Json::decode($exam['exam'])['exam'];
$many = count($data);
$this->title = 'Take Exam';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['value' => Json::decode($exam['exam'])['title']]) ?>
<p> <h3  style='color: red;'>For the right answer just put the ' * ' symbol at the end of its text ...</h3></p>

<?php foreach ($data as $key => $question) {?>
<?php $i = 1; ?>
    <?= $form->field($model, 'questions[]')->label($key)->textarea(['rows' => 6, 'value' => $question['text']]) ?>
    <?php $i = 1; ?>
    <?php foreach($question['answers'] as $ke => $ans) { ?>
        <?php if($ke == $question['right']) { ?>
            <?= $form->field($model, 'answers[]')->label('Answer '.$i)->textInput(['value' => $ans . '*']) ?>
        <?php } else { ?>
            <?= $form->field($model, 'answers[]')->label('Answer '.$i)->textInput(['value' => $ans]) ?>
        <?php } $i++; ?>
    <?php }?>
<br>
<hr style="border-bottom: solid;">
        <?php } ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>