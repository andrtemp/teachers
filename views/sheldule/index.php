<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\ActiveForm;
use nex\datepicker\DatePicker;
use dosamigos\select2\Select2;

foreach ($clients as $key => $value) {
	$client[$value['id']]=array('name' => $value->person->name.' '.$value->person->second_name, 'phone' => $value->person->phone, 'stake' => $value->tarif);
	$filter_client[$value['id']] = $value->person->name.' '.$value->person->second_name;
}
foreach ($coaches as $key => $value) {
	$coach[$value['id']]=array('name' => $value->person->name.' '.$value->person->second_name, 'phone' => $value->person->phone, 'tarif' =>$value->tarif);
	$filter_coach[$value['id']] = $value->person->name.' '.$value->person->second_name;
}
foreach ($status_type as $key => $value) {
	$status[$value['id']-1]=$value['name'];
}

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShelduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$check = array();
$info = array();
foreach ($model as $value) {
	array_push($check, $value['date'].' '.$value['time'].' '.$value['hall_id']);
	if(!isset($info[$value['date'].' '.$value['time'].' '.$value['hall_id']])){
		$info[$value['date'].' '.$value['time'].' '.$value['hall_id']]=array();
	}
	array_push($info[$value['date'].' '.$value['time'].' '.$value['hall_id']],$value);
	$new_time = $value['time'];
	while(strtotime($new_time)<strtotime($value['end_time'])){
		array_push($check, $value['date'].' '.$new_time.' '.$value['hall_id']);
		$new_time = date('H:i:s',strtotime('+30 minutes',strtotime($new_time)));
		if(!isset($info[$value['date'].' '.$new_time.' '.$value['hall_id']])){
			$info[$value['date'].' '.$new_time.' '.$value['hall_id']]=array();
		}
		if(strtotime($new_time)<strtotime($value['end_time']))
		array_push($info[$value['date'].' '.$new_time.' '.$value['hall_id']],$value);
	}
}

//var_dump($check);
$this->title = 'Расписание';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sheldule-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if($disabled) Html::a('Создать запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
    	<div class="col-lg-6">
	        <?= Html::a('Студия Подол', ['show'], ['data' => ['method' => 'post', 'params'=>['id' => 1, 'date' => $current_date]], 'class' => 'btn btn-success']) ?>
	        <?= Html::a('Студия Театральная', ['show'], [ 'data' => ['method' => 'post', 'params'=>['id' => 2, 'date' => $current_date]],'class' => 'btn btn-success']) ?>
	        <?= Html::a('Студия Институт физкультуры', ['show'], ['data' => ['method' => 'post', 'params'=>['id' => 3, 'date' => $current_date]], 'class' => 'btn btn-success']) ?>
    	</div>
        <div class="col-lg-6">
        	<div class="row">
	        	<div class="col-lg-6">
		        	
					<?= 
						Select2::widget([
						    'name' => 'coach_filter',
				            'items' => $filter_coach,
				            'clientOptions' => ['theme' => 'classic'],
						    'options' => ['placeholder' => 'Выбрать теренера']
						]);
				    ?>
				</div>
				<div class="col-lg-6">
					<?= 
						Select2::widget([
						    'name' => 'client_filter',
				            'items' => $filter_client,
				            'clientOptions' => ['theme' => 'classic'],
						    'options' => ['placeholder' => 'Выбрать клиента']
						]);
				    ?>
				</div>
			</div>
			<div class="row" style="margin-top: 10px">
				<div class="col-lg-6">
				    <?= DatePicker::widget([
				    'name' => 'datepickerTest',
				    'id' => 'picker',
				    'value' => date('m/d/Y',strtotime($current_date)),
				    'clientOptions' => [
				        'format' => 'L',
				    ],
				    'dropdownItems' => [
				        ['label' => 'Previous week', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('-1 week')],
				        ['label' => 'Next week', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('+1 week')],
				        ['label' => 'Some value', 'url' => '#', 'value' => 'Special value'],
				    ],
					]);?>
				</div>
				<div class="col-lg-6">
					<?= Html::a('Фильтровать', ['show'], ['data' => ['method' => 'post', 'params'=>['id' => $current_id, 'date' => $current_date, 'coach' => null, 'client' => null]], 'class' => 'btn btn-success','id' =>'select_date']) ?>
				</div>
			</div>
        </div>
    </p>
    <br/>
    <hr/>

    <div class="sheld_table">
    <?= $this->render('table', [
        'model' => $model,
        'client' => $client,
        'status' => $status,
        'coach' => $coach,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'interval' => $interval,
        'date' => date('d-m-Y'),
        'check' => $check,
        'halls' => $halls,
        'info' => $info,
        'week' => $week,
        'disabled' => $disabled
    ])?>
</div>
</div>