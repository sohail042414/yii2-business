<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\Sale;

/* @var $this yii\web\View */
/* @var $model app\models\Sale */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sale-view">

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
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'bill_no',
                    'bill_book_no',
                    [
                        'attribute' => 'client_id',
                        'value' => $model->client->name,     
                    ],
                    [
                        'attribute' => 'client_city',
                        'value' => $model->client->city->name,     
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
                        'label' => 'Item no',
                        'attribute' => 'item_id',
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'value' => function ($data) {
                            return $data->getItem()->one()->item_no; // $data['name'] for array data, e.g. using SqlDataProvider.
                        },
                    ],
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
                        'footer' => "Total : ".Sale::getTotal($dataProvider->models, 'quantity'),       
                    ],
                    'shortage',
                    [
                        'attribute' => 'total_weight',
                        'footer' => "Total : ".Sale::getTotal($dataProvider->models, 'total_weight'),       
                    ],                    
                    'sale_price',
                    [
                        'attribute' => 'sale_total',
                        'label' => 'Total',
                        'footer' => "Total : ".Sale::getTotal($dataProvider->models, 'sale_total'),       
                    ],
                    //'weight',
               
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
                                $url = Url::toRoute(['sale-item/delete','id'=>$model->id]);
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
