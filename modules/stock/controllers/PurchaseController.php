<?php

namespace app\modules\stock\controllers;

use Yii;
use app\models\Purchase;
use app\models\SearchPurchase;
use app\models\PurchaseItem;
use app\models\SearchPurchaseItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
{
    /**
     * {@inheritdoc}
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

    /**
     * Lists all Purchase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchPurchase();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
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
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Purchase();
        
        $form_data = array();

        if(\Yii::$app->request->isPost) {
            $form_data = Yii::$app->request->post();               
            $form_data['Purchase']['status'] = 'new';        
        }

        if ($model->load($form_data) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Purchase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        
        $form_data = array();

        if(\Yii::$app->request->isPost) {
            $form_data = Yii::$app->request->post();
            $form_data['Purchase']['status'] = 'new';
        }
        

        $searchModel = new SearchPurchaseItem();
        $searchModel->purchase_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $purchase_item = new PurchaseItem();
        $purchase_item->purchase_id = $id;

        if ($model->load($form_data) && $model->save()) {
            
            Yii::$app->session->setFlash('success_message', "Purchase information updated!");

            if($model->status == 'complete'){
                return $this->redirect(['view', 'id' => $model->id]);
            }

            //return $this->redirect(['update', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
            'purchase_item' => $purchase_item,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Purchase model.
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
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
