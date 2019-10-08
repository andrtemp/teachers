<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\CHtml;
use dosamigos\select2\Select2;
use app\models\Client;
/* @var $this yii\web\View */
/* @var $model app\models\Sheldule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheldule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput()?>


     <?= $form->field($model, 'client')->widget(
        Select2::classname(), 
        [
            'items' => $clients,
            'clientOptions' => ['theme' => 'classic']
        ]
    );
     ?>
     

    <?= $form->field($model, 'coach')->widget(
        Select2::classname(), 
        [
            'items' => $coaches,
            'clientOptions' => ['theme' => 'classic']
        ]
    );?>

    <?= $form->field($model, 'type_note')->DropDownList($status)?>

    <?= $form->field($model, 'hall_id')->DropDownList($halls)?>

    <?= $form->field($model, 'done')->checkbox() ?>
	
	<div class="form-group">   
        <label for="counter">Введите количество недель (для регулярных занятий)</label>
        <?= Html::textInput('counter', $count,['class' => 'form form-control', 'placeholder' => 'Введите количество недель']) ?>
    </div>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>