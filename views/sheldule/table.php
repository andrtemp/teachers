<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

 ?>
<div class="table-head">
    <table class="table table-bordered">
        <thead>
    	    <tr>
    			<th rowspan="2">Дата</th>
    			<?php
    			foreach ($week as $key => $value) {
    				echo '<th colspan="'.count($halls).'" class="border_r border_l">'.$value.'<br>'.$key.'</th>';
    			}
    			?>
    		</tr>
    		<tr>
    			<?php
    			for($i=1;$i<8;$i++){
    				for($j=1;$j<=count($halls);$j++){
    					echo '<th>Группа '.$j.'</th>';
    				}
    			}
    			?>
    		</tr>
    	</thead> 
    </table>
    
</div>
 <table class="table table-bordered sheldule_table">
	<tbody>
		<?php
		$temp = explode(':',$start_time);
		$stime = $temp[0]*60+$temp[1];
		$temp = explode(':',$end_time);
		$etime = $temp[0]*60+$temp[1];
		$time = $stime;
		for ($i=0; $i < intval(($etime-$stime)/$interval); $i++) { 
			echo '<tr>';
			$h = intval($time/60);
			$m = $time%60;
			if($m==0){$m='00';};
			if(strlen($h)==1){$h='0'.$h;};
			if(strlen($m)==1){$m='0'.$m;};
			echo '<th>'.date($h.':'.$m).'</th>';
			$time += $interval;
			$first_day = new DateTime(date('Y-m-d',strtotime($week['Понедельник'])));
			$first_day = $first_day->modify('-1 day');
			for($j=0;$j<7;$j++){
				//$day = date('d',strtotime($week['Понедельник']))+$j;
				//if(strlen($day)==1){$day='0'.$day;};
				$first_day = $first_day->modify('+1 day');
				$full_date = $first_day->format('Y-m-d');
				$t = $full_date.' '.date($h.':'.$m).':00';
				//var_dump($t);
				for($k=0;$k<count($halls);$k++){
					$checked = '';
					if(in_array($t.' '.$halls[$k],$check)){
						$modal_label = '';
						$modal_text = '';
						foreach ($info[$t.' '.$halls[$k]] as $value) {
							if($value['done']==1){
								$class='done';
								$checked='checked'; 
							}
							else{
								switch ($value['type_note']) {
									case 2:
										$class='lease';
										break;
									case 3:
										$class='individual';
										break;
									case 4:
										$class='group';
										break;
									default:
										$class='free';
										break;
								}	
							}
							if($k==0){
							    $class.=' border_r';
							}
							if($k==count($halls)-1){
							    $class.=' border_l';
							}
							if(isset($value['coach'])){
								$cr7 = $coach[$value['coach']];
							}
							else{
								$cr7 = array('name' => '', 'phone' => '', 'tarif' =>'');
							}
							if(isset($value['client'])){
								$mess = $client[$value['client']];
							}
							else{
								$mess = array('name' => '', 'phone' => '', 'stake' =>'');
							}
							$modal_label .=date('H:i',strtotime($value['time'])).'-'.date('H:i',strtotime($value['end_time'])).'<br>'.$mess['name'].'<br>'.$cr7['name'].'<hr/>';
							$modal_text .= '<p>Тип занятия: '.$status[$value['type_note']-1].'</p><p>Дата и время: '.$value['date'].' | '.date('H:i',strtotime($value['time'])).' - '.date('H:i',strtotime($value['end_time'])).'</p>'.'<p>Студент: '.$mess['name'].' | '.$mess['phone'].' | '.$mess['stake'].'</p><p>Преподаватель: '.$cr7['name'].' | '.$cr7['phone'].' | '.$cr7['tarif'].'</p><p>Заметки: '.$value['note'].'</p>';
							$modal_text .= ($disabled) ? '<input class="status_l" name="status_" type="checkbox" data-url="'.Url::to(['checked']).'" data-id="'.$value['id'].'" '.$checked.'><label for="status_">Выполнено</label>'.Html::a('Удалить', ['delete', 'id' => $value['id']], [
								'class' => 'btn btn-warning',
								'data' => [
									'confirm' => 'Уверены, что хотите удалить?',
									'method' => 'post',
								],
							]).Html::a('Редактировать', ['update', 'id' => $value['id']], [
								'class' => 'btn btn-info',
								'data' => [
									'method' => 'post',
								],
							]) : '';
						}
						$footer_for_modal = ($disabled) ? Html::a('Удалить', ['delete', 'id' => $value['id']], [
								'class' => 'btn btn-danger',
								'data' => [
									'confirm' => 'Уверены, что хотите удалить?',
									'method' => 'post',
								],
							]) : '';
							
						if(!($value['type_note'] == 2 || $value['type_note'] == 4 || !$disabled)){
						   $footer_for_modal.=Html::a('Создать занятие', ['create'],[
								'data'=>[
									'method' => 'post',
									//'confirm' => 'Are you sure?',
									'params'=>['date'=>$full_date, 'time'=>$h.':'.$m,'hall'=>$halls[$k],],
								]
								,'class' => 'btn btn-success']);
						}
					    if($disabled) {
					        Modal::begin([
    						    'header' => '<h2>Занятие</h2>',
    						    'toggleButton' => ['label' => \yii\helpers\StringHelper::truncate($modal_label,50,'...'),'tag'=>'td','class'=>$class.' custom_c','data-time' => $h.':'.$m,'data-date' => $full_date,],
    						    'footer' => $footer_for_modal,
    					    ]);
    						    echo $modal_text;
    						Modal::end();
					    } else{
					        echo Html::tag('td', \yii\helpers\StringHelper::truncate($modal_label,50,'...'), ['class' => $class.' custom_c']);
					    }
					}
					else{
					    $class='free';
							if($k==0){
							    $class.=' border_l';
							}
							if($k==count($halls)-1){
							    $class.=' border_r';
							}
						$footer_for_modal = ($disabled) ? (Html::a('Создать запись', ['create'],[
							'data'=>[
								'method' => 'post',
								//'confirm' => 'Are you sure?',
								'params'=>['date'=>$full_date, 'time'=>$h.':'.$m,'hall'=>$halls[$k],],
							]
							,'class' => 'btn btn-success'])) : '';
						if($disabled) {
						    Modal::begin([
        					    'header' => '<h2>Свободно</h2>',
        					    'toggleButton' => ['label' => '<p>'.date($h.':'.$m).'</p>','tag'=>'td','class'=>$class.' span_col custom_c','data-time' => $h.':'.$m,'data-date' => $full_date,],
        					    'footer' => $footer_for_modal,
    						]);
    						
    						Modal::end();
						} else{
					        echo Html::tag('td', '<p>'.date($h.':'.$m).'</p>', ['class' => $class.' span_col custom_c']);
						}
					}
				}
			}
			echo '</tr>';
		}
		?>
	</tbody>
</table>