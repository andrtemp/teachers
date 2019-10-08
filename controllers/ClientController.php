<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\ClientSearch;
use app\models\Person;
use app\models\PersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
                if(\Yii::$app->user->id > 101){
                    echo 'Войдите в систему пользователем у которого есть доступ к эти действиям, у вас нет доступа.';
                    return false;
                    //$this->layout = 'watch';
                }
                return true;
            }
            echo 'Войдите в систему пользователем у которого есть доступ к эти действиям, у вас нет доступа.';
        } else {
            return false;
        }
    }

    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
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
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();
        $model_p = new Person();
        //var_dump(Yii::$app->request->post());die;

        if ($model_p->load(Yii::$app->request->post())) {
             if($model_p->save()){
                $person_id = $model_p->id;
                $model->person_id = $person_id;
                if($model->load(Yii::$app->request->post())&&$model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
             }
        }

        return $this->render('create', [
            'model' => $model,
            'model_p' =>$model_p,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pc = new Person();
        $model_p = $pc->findOne($model->person_id);

        if ($model_p->load(Yii::$app->request->post())) {
             if($model_p->save()){
                $person_id = $model_p->id;
                $model->person_id = $person_id;
                if($model->load(Yii::$app->request->post())&&$model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
             }
        }

        return $this->render('update', [
            'model' => $model,
            'model_p' => $model_p,
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}