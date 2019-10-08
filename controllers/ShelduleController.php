<?php

namespace app\controllers;

use Yii;
use app\models\Sheldule;
use app\models\ShelduleSearch;
use app\models\Client;
use app\models\ClientSearch;
use app\models\Coach;
use app\models\CoachSearch;
use app\models\Status;
use app\models\StatusSearch;
use app\models\Hall;
use app\models\HallSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ShelduleController implements the CRUD actions for Sheldule model.
 */
class ShelduleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->isGuest) {
                return true;
            }
            echo 'Войдите в систему, у вас нет доступа.';
        } else {
            return false;
        }
    }
    /**
     * Lists all Sheldule models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->id < 102) {
            $disabled = true;
        }
        else {
            $disabled = false;
            $this->layout = 'watch';
        }
        $searchModel = new ShelduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $week = $this->getArrayDay(date('Y-m-d'));
        $model = Sheldule::find()->where(['between', 'date', $week['Понедельник'], $week['Воскресенье'] ])->all();
        $clients = Client::find()->all();
        $coaches = Coach::find()->all();
        $status = Status::find()->all();
        $studio = 1;
        $date=date('Y-m-d');
        switch ($studio) {
            case 1:
                $halls=[1,2,3];
                break;
            case 2:
                $halls=[4,5];
                break;
            case 3:
                $halls=[6];
                break;
            default:
                $halls=[1,2,3,4,5,6];
                break;
        }
        //var_dump($week['Воскресенье'].'  '.$week['Понедельник']);die;
        //var_dump($model);die;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'start_time' => '8:30',
            'end_time' => '22:30',
            'interval' => 30,
            'clients' => $clients,
            'coaches' => $coaches,
            'status_type' => $status,
            'model' => $model,
            'week' => $week,
            'halls' => $halls,
            'current_date' => $date,
            'current_id' => $studio,
            'disabled' => $disabled
        ]);
    }

    public function actionShow($studio = 1, $date = null, $coach = null, $client = null){
        if(\Yii::$app->user->id < 102) {
            $disabled = true;
        }
        else {
            $disabled = false;
            $this->layout = 'watch';
        }
        $date = date('Y-m-d');
        $getParams = Yii::$app->request->get();
        $postParams = Yii::$app->request->post();
        if (isset($getParams['id'])){
            $studio = $getParams['id'];
        }
        if(isset($getParams['date'])){
            $date = $getParams['date'];
        }
        if(isset($getParams['coach'])){
            $coach = $getParams['coach'];
        }
        if(isset($getParams['client'])){
            $client = $getParams['client'];
        }
        if (isset($postParams['id'])){
            $studio = $postParams['id'];
        }
        if(isset($postParams['date'])){
            $date = $postParams['date'];
        }
        if(isset($postParams['coach'])){
            $coach = $postParams['coach'];
        }
        if(isset($postParams['client'])){
            $client = $postParams['client'];
        }
        $week = $this->getArrayDay($date);
        switch ($studio) {
            case 1:
                $halls=[1,2,3];
                break;
            case 2:
                $halls=[4,5];
                break;
            case 3:
                $halls=[6];
                break;
            default:
                $halls=[1,2,3];
                break;
        }
        $req = Sheldule::find()->where(['between', 'date', $week['Понедельник'], $week['Воскресенье'] ])
            ->andWhere(['in','hall_id', $halls]);
        if(!empty($coach))
            $req->andWhere(['coach' => $coach]);
        if(!empty($client))
            $req->andWhere(['client' => $client]);
        $model = $req->all();
        //$halls = Hall::find()->where(['studio_id' => $studio])->all();
        $coaches = Coach::find()->all();
        $clients = Client::find()->all();
        $status = Status::find()->all();

        return $this->render('index', [
            //'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
            'start_time' => '8:30',
            'end_time' => '22:30',
            'interval' => 30,
            'clients' => $clients,
            'coaches' => $coaches,
            'status_type' => $status,
            'model' => $model,
            'week' => $week,
            'halls' => $halls,
            'current_date' => $date,
            'current_id' => $studio,
            'disabled' => $disabled
        ]);
    }

    /**
     * Displays a single Sheldule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sheldule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sheldule();
        $clients = ArrayHelper::map(Client::find()->all(), 'id',
            function($model) {
                return $model->person->name.' '.$model->person->second_name;}
        );
        $coaches = ArrayHelper::map(Coach::find()->all(), 'id',
            function($model) {
                return $model->person->name.' '.$model->person->second_name;}
        );
        $status = ArrayHelper::map(Status::find()->all(), 'id', 'name');
        $hall = ArrayHelper::map(Hall::find()->all(), 'id',
            function($model) {
                return $model->studio->name.' '.$model->name;}
        );
        //var_dump(Yii::$app->request->post());die;
        if(isset(Yii::$app->request->post()['time'])){
            $model->time=Yii::$app->request->post()['time'];
            $model->end_time=date('H:i',strtotime('+30 minutes',strtotime(Yii::$app->request->post()['time'])));
            $model->date=date('Y-m-d',strtotime(Yii::$app->request->post()['date']));
            $model->hall_id=Yii::$app->request->post()['hall'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $post_data = Yii::$app->request->post();
            $start_date = $model->date;
            $counter = Yii::$app->request->post('counter');
            if ($model->type_note == 2){
                $model->coach = null;
            }
            if($model->type_note == 4){
                $model->client = null;
            }
            while ( $counter > 1) {
                $model->save();
                unset($model);
                $model = new Sheldule();
                $model->load($post_data);
                $start_date = date('Y-m-d',strtotime('+7 days',strtotime($start_date)));
                $model->date = $start_date;
				if ($model->type_note == 2){
                    $model->coach = null;
				}
				if($model->type_note == 4){
					$model->client = null;
				}
                $counter--;
            }
			$model->save();
            $Hall = new Hall();
            $current_hall = $Hall::findOne($model->hall_id);
            return $this->redirect(['show', 'date' => $model->date, 'id' => $current_hall->studio_id]);
        }
        $count = 1;

        return $this->render('create', [
            'model' => $model,
            'clients' => $clients,
            'coaches' => $coaches,
            'status' => $status,
            'halls' => $hall,
            'count' => $count,
        ]);
    }

    /**
     * Updates an existing Sheldule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$clients = ArrayHelper::map(Client::find()->all(), 'id',
            function($model) {
                return $model->person->name.' '.$model->person->second_name;}
        );
        $coaches = ArrayHelper::map(Coach::find()->all(), 'id',
            function($model) {
                return $model->person->name.' '.$model->person->second_name;}
        );
        $status = ArrayHelper::map(Status::find()->all(), 'id', 'name');
        $hall = ArrayHelper::map(Hall::find()->all(), 'id',
            function($model) {
                return $model->studio->name.' '.$model->name;}
        );
        if ($model->load(Yii::$app->request->post())) {
            if ($model->type_note == 2){
                $model->coach = null;
            }
            if($model->type_note == 4){
                $model->client = null;
            }
            $Hall = new Hall();
            $current_hall = $Hall::findOne($model->hall_id);
            if($model->save())
                return $this->redirect(['show', 'date' => $model->date, 'id' => $current_hall->studio_id]);
        }
        $count = 1;

        return $this->render('update', [
            'model' => $model,
            'clients' => $clients,
            'coaches' => $coaches,
            'status' => $status,
            'halls' => $hall,
            'count' => $count,
        ]);
    }

    /**
     * Deletes an existing Sheldule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model =  $this->findModel($id);
        $date = $model->date;
        $Hall = new Hall();
        $current_hall = $Hall::findOne($model->hall_id);
        $hid = $current_hall->studio_id;
        $this->findModel($id)->delete();

        return $this->redirect(['show', 'date' => $date, 'id' => $hid]);
    }

    public function actionChecked(){
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if($model->done == 0){
            $model->done = 1;
            echo true;
        }
        else{
            $model->done = 0;
            echo false;
        }
        $model->save();
    }

    public function getArrayDay($date){
        $week = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
        //$input = explode('/', $date);
        //var_dump($date);die;
        $result = array();
        $dw = date('N',strtotime($date));
        if($dw==1){
            $result['Понедельник'] = date('Y-m-d',strtotime('Monday '.$date));
            $result['Вторник'] = date('Y-m-d',strtotime('Tuesday '.$date));
            $result['Среда'] = date('Y-m-d',strtotime('Wednesday '.$date));
            $result['Четверг'] = date('Y-m-d',strtotime('Thursday '.$date));
            $result['Пятница'] = date('Y-m-d',strtotime('Friday '.$date));
            $result['Суббота'] = date('Y-m-d',strtotime('Saturday '.$date));
            $result['Воскресенье'] = date('Y-m-d',strtotime('Sunday '.$date));
        }
        else{
            $result['Понедельник'] = date('Y-m-d',strtotime('last Monday '.$date));
            $date = $result['Понедельник'];
            $result['Вторник'] = date('Y-m-d',strtotime('Tuesday '.$date));
            $result['Среда'] = date('Y-m-d',strtotime('Wednesday '.$date));
            $result['Четверг'] = date('Y-m-d',strtotime('Thursday '.$date));
            $result['Пятница'] = date('Y-m-d',strtotime('Friday '.$date));
            $result['Суббота'] = date('Y-m-d',strtotime('Saturday '.$date));
            $result['Воскресенье'] = date('Y-m-d',strtotime('Sunday '.$date));
        }
        return $result;
    }

    /**
     * Finds the Sheldule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sheldule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sheldule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}