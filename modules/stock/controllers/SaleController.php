<?php

namespace app\modules\stock\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Sale;
use app\models\SaleItem;
use app\models\SearchSale;
use app\models\SearchSaleItem;


/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','create','update','view','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchSale();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new SearchSaleItem();
        $searchModel->sale_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sale();
        
        $id = 0;

        $searchModel = new SearchSaleItem();
        $searchModel->sale_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sale_item = new SaleItem();
        $sale_item->sale_id = $id;

        $form_data = array();

        if(\Yii::$app->request->isPost) {
            $form_data = Yii::$app->request->post();               
            $form_data['Sale']['status'] = 'new';        
        }

        $model->total_amount = 0;
        $model->cash_amount = 0;
        $model->debit_amount = 0;
        $model->previous_balance=0;
        $model->builty_charges=0;
        $model->labour_charges=0;
        $model->other_charges=0;
        $model->discount = 0;


        if ($model->load($form_data) && $model->save()) {
     
            if(!empty($form_data['SaleItem']['item_id'])){

                $sale_item->load($form_data);
                $sale_item->sale_id = $model->id;                
                
                if($sale_item->save()){
                    $model->calculateTotalAmount();
                    return $this->redirect(['update', 'id' => $model->id]);            
                }else{
                    echo '<pre>';
                    print_r($sale_item->errors);
                    exit; 
                }
            }

        }

        return $this->render('create', [
            'model' => $model,
            'sale_item' => $sale_item,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Sale model.
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
            //$form_data['Purchase']['status'] = 'new';
        }
        
        $searchModel = new SearchSaleItem();
        $searchModel->sale_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sale_item = new SaleItem();
        $sale_item->sale_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(!empty($form_data['SaleItem']['item_id'])){
                $sale_item->load($form_data);
                $sale_item->sale_id = $model->id;
                $sale_item->save();    
            }
            
            $model->calculateTotalAmount();

            if($model->status == 'complete'){
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        //$model->getNetTotal();

        return $this->render('update', [
            'model' => $model,
            'sale_item' => $sale_item,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Sale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        $model = $this->findModel($id);
        if($model->status == 'new'){
            $model->delete();
            Yii::$app->session->setFlash('success_message', "Bill/Sale deleted!");
        }else{
            Yii::$app->session->setFlash('error_message', "Cannot delete the Bill/Sale!");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
