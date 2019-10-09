<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Преподаватели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coach-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить преподавателя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Имя',
                'attribute' => 'personName',
            ],
            [
                'label' => 'Фамилия',
                'attribute' => 'personSecondName',
            ],
            [
                'label' => 'Номер телефона',
                'attribute' => 'personPhone',
            ],
            'tarif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
