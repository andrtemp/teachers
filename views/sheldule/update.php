<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sheldule */

$this->title = 'Редактировать запись: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="sheldule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
            'clients' => $clients,
            'coaches' => $coaches,
            'status' => $status,
            'halls' => $halls,
            'count' => $count,
    ]) ?>

</div>