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
                    //'delete' => ['POST'],
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

        $searchModel = new SearchPurchaseItem();
        $searchModel->purchase_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        $model->total_amount = 0;
        $model->cash_amount = 0;
        $model->credit_amount = 0;
        $model->previous_balance=0;
        $model->builty_charges=0;
        $model->labour_charges=0;
        $model->other_charges=0;
        $model->discount = 0;

        $searchModel = new SearchPurchaseItem();
        $searchModel->purchase_id = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $purchase_item = new PurchaseItem();
        $purchase_item->quantity = 1;

        if ($model->load($form_data) && $model->save()) {

            // echo "<pre>";
            // print_r($form_data);
            // exit;

            $purchase_item->load($form_data);
            $purchase_item->purchase_id = $model->id;
            $purchase_item->purchase_total = $purchase_item->purchase_price*$purchase_item->quantity;
            $purchase_item->total_weight = $purchase_item->weight*$purchase_item->quantity;

            if($purchase_item->save()){
                $model->calculateTotalAmount();
                return $this->redirect(['update', 'id' => $model->id]);            
            }else{
                echo '<pre>';
                print_r($purchase_item->errors);
                exit; 
            }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'purchase_item' => $purchase_item,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if(!empty($form_data['PurchaseItem']['item_id'])){
       
                $purchase_item->load($form_data);
                $purchase_item->purchase_id = $model->id;
                $purchase_item->purchase_total = $purchase_item->purchase_price*$purchase_item->quantity;
                $purchase_item->total_weight = $purchase_item->weight*$purchase_item->quantity;
                $purchase_item->save();    
            }
            
            $model->calculateTotalAmount();

            if($model->status == 'complete'){
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->redirect(['update', 'id' => $model->id]);
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

        $model = $this->findModel($id);
        if($model->status == 'new'){
            $model->delete();
            Yii::$app->session->setFlash('success_message', "Purchase deleted!");
        }else{
            Yii::$app->session->setFlash('error_message', "Cannot delete the purchase!");
        }

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
