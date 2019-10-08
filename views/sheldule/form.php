<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sheldule */
/* @var $form ActiveForm */
?>
<div class="sheldule-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'time') ?>
        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'client') ?>
        <?= $form->field($model, 'type_note') ?>
        <?= $form->field($model, 'coach') ?>
        <?= $form->field($model, 'note') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- sheldule-form -->
