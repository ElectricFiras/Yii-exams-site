<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'question1')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'answer1') ?>
    <?= $form->field($model, 'answer2') ?>
    <?= $form->field($model, 'answer3') ?>
    <?= $form->field($model, 'answer4') ?>
    
    <?= $form->field($model, 'question2')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'answer5') ?>
    <?= $form->field($model, 'answer6') ?>
    <?= $form->field($model, 'answer7') ?>
    <?= $form->field($model, 'answer8') ?>
        
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>