<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\Purchase;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?php 
    
    // DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'id',
    //         'vendor_id',
    //         'notes:ntext',
    //         'total_amount',
    //         'status',
    //         'created_at',
    //         'updated_at',
    //     ],
    // ])
    
    ?>


<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'bill_no',
                    'bill_book_no',
                    [
                        'attribute' => 'vendor_id',
                        'value' => $model->vendor->name,     
                    ],
                    [
                        'attribute' => 'client_city',
                        'value' => $model->vendor->city->name,     
                    ],

                ],
            ]) ?>    
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'bill_date',
                    'builty_no',
                    'cargo_terminal',
                    'vehicle_no',
                ],
            ]) ?>    
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'summary' => '',
                'showFooter' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'item_id',
                    [
                        'label' => 'Item Name',
                        'attribute' => 'item_id',
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'value' => function ($data) {
                            return $data->getItem()->one()->name; // $data['name'] for array data, e.g. using SqlDataProvider.
                        },
                    ],
                    [
                        'attribute' => 'quantity',
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'quantity'),       
                    ],                                        
                    'purchase_price',
                    [
                        'attribute' => 'purchase_total',
                        'label' => 'Total',
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'purchase_total'),       
                    ],
                    'weight',
                    [
                        'attribute' => 'total_weight',
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'total_weight'),       
                    ],
                    'shortage',               
                    //['class' => 'yii\grid\ActionColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'lead-delete'),
                                ]);
                            }
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'delete') {
                                //$url = 'stock/purchase-item/delete?id=' . $model->id;
                                $url = Url::toRoute(['purchase-item/delete','id'=>$model->id]);
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'total_amount',
                    'builty_charges',
                    'labour_charges',                    
                ],
            ]) ?>    
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [  
                    'other_charges',                  
                    'discount',
                    'previous_balance',
                    [
                        'attribute' => 'net_balance',
                        'value' => $model->getNetTotal()     
                    ],
                ],
            ]) ?>    
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'notes',
                ],
            ]) ?>    
        </div>
    </div>



</div>
