<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->person->name.' '.$model->person->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->person->name.' '.$model->person->second_name;
?>
<div class="client-view">

    <h1><?= Html::encode($model->person->name.' '.$model->person->second_name) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Имя',
                'attribute' => 'person.name',
            ],
            [
                'label' => 'Фамилия',
                'attribute' => 'person.second_name',
            ],
            [
                'label' => 'Номер телефона',
                'attribute' => 'person.phone',
            ],
            [
                'label' => 'Социальная сеть',
                'attribute' => 'social',
            ],
            [
                'label' => 'Тариф',
                'attribute' => 'tarif',
            ],
            [
                'label' => 'Заметки',
                'attribute' => 'note',
            ],
        ],
    ]) ?>

</div>
