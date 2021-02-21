<?php

namespace app\modules\stock\controllers;

use Yii;
use app\models\SaleItem;
use app\models\Item;
use app\models\Sale;
use app\models\SearchSaleItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaleItemController implements the CRUD actions for SaleItem model.
 */
class SaleItemController extends Controller
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
     * Lists all SaleItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchSaleItem();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SaleItem model.
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
     * Creates a new SaleItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
        $model = new SaleItem();

        if ($model->load(Yii::$app->request->post())) {

            $model->sale_total = $model->sale_price*$model->quantity;
            $model->total_weight = $model->weight*$model->quantity;

            if($model->save()){

                $sale = Sale::find($model->sale_id)->one();

                $sale->calculateTotalAmount();

                Yii::$app->session->setFlash('success_message', "Item Added!");   

            }else{
                Yii::$app->session->setFlash('error_message', "Item not added, there was some error !");
            }          
        }

        return $this->redirect(['sale/update', 'id' => $model->sale_id]);
    }

    /*
    public function actionCreate222()
    {
        $model = new SaleItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    */
    /**
     * Updates an existing SaleItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SaleItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $sale_id = $model->sale_id;
        $model->delete();
        $sale = Sale::find($sale_id)->one();
        $sale->calculateTotalAmount();
        Yii::$app->session->setFlash('success_message', "Itm deleted");
        return $this->redirect(Yii::$app->request->referrer ?: ['sale/update', 'id' => $sale_id]);
        //return $this->redirect(['sale/update', 'id' => $sale_id]);

        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);
    }


    public function actionDetails()
    {
        $id = Yii::$app->request->post('id');
        
        $data = Item::findOne($id)->toArray();
        
        return $this->asJson($data);
        
    }
    /**
     * Finds the SaleItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SaleItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SaleItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
