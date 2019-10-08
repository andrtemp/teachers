<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model_p, 'name')->textInput() ?>

    <?= $form->field($model_p, 'second_name')->textInput() ?>

    <?= $form->field($model_p, 'date_of_birth')->textInput() ?>

    <?= $form->field($model_p, 'phone')->textInput() ?>

    <?= $form->field($model, 'second_phone')->textInput() ?>

    <?= $form->field($model, 'social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarif')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
