<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Coach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coach-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model_p, 'name')->textInput() ?>

    <?= $form->field($model_p, 'second_name')->textInput() ?>

    <?= $form->field($model_p, 'date_of_birth')->textInput() ?>

    <?= $form->field($model_p, 'phone')->textInput() ?>

    <?= $form->field($model, 'tarif')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
