<?php

namespace app\modules\stock\controllers;

use Yii;
use app\models\Purchase;
use app\models\Item;
use app\models\PurchaseItem;
use app\models\SearchPurchaseItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseitemController implements the CRUD actions for PurchaseItem model.
 */
class PurchaseItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];

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
     * Lists all PurchaseItem models.
     * @return mixed
     */
    public function actionIndex()
    {
      return false;
        // $searchModel = new SearchPurchaseItem();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }

    /**
     * Displays a single PurchaseItem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return false;
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new PurchaseItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurchaseItem();

        if ($model->load(Yii::$app->request->post())) {

            $model->purchase_total = $model->purchase_price*$model->quantity;
            if($model->save()){

                $purchase = Purchase::find($model->purchase_id)->one();

                $purchase->calculateTotalAmount();

                Yii::$app->session->setFlash('success_message', "Item Added!");   

            }else{
                Yii::$app->session->setFlash('error_message', "Item not added, there was some error !");
            }          
        }

        return $this->redirect(['purchase/update', 'id' => $model->purchase_id]);


        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing PurchaseItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        return false;
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Deletes an existing PurchaseItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $purchase_id = $model->purchase_id;
        $model->delete();
        $purchase = Purchase::find($purchase_id)->one();
        $purchase->calculateTotalAmount();
        Yii::$app->session->setFlash('success_message', "Itm deleted");
        return $this->redirect(['purchase/update', 'id' => $purchase_id]);
        //$this->findModel($id)->delete();
        //return $this->redirect(['index']);
    }


    /**
     * Displays a single PurchaseItem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetails()
    {
        $id = Yii::$app->request->post('id');
        
        $data = Item::findOne($id)->toArray();
        
        return $this->asJson($data);
        
    }

    /**
     * Finds the PurchaseItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
