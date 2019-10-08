<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sheldule */

$this->title = 'Запись';
$this->params['breadcrumbs'][] = ['label' => 'Расписание', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheldule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clients' => $clients,
        'status' => $status,
        'coaches' => $coaches,
        'halls' => $halls,
        'count' => $count,
    ]) ?>

</div>