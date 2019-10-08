<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Coach */

$this->title = 'Обновить тренера:';
$this->params['breadcrumbs'][] = ['label' => 'Тренеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="coach-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_p' => $model_p,
    ]) ?>

</div>
