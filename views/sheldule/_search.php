<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShelduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheldule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'client') ?>

    <?= $form->field($model, 'coach') ?>

    <?php // echo $form->field($model, 'type_note') ?>

    <?php // echo $form->field($model, 'hall_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
