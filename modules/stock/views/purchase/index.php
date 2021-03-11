<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchPurchase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchases');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Purchase'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'vendor_id',
                'label' => 'Supplier',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return $data->getVendor()->one()->name; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            'total_amount',
            'bill_date',
            [
                'attribute' => 'status',
                'filter'=> Html::dropDownList('SearchPurchase[status]','',['new'=>'New','complete'=>'Complete'],['prompt'=>'Select','class' => 'form-control']),

            ],
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 150px;'],
                'header'=>'Actions',
                'template' => '{view} {update} {delete}',            
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-eye-open"></span>',             
                            $url,['class'=>'btn btn-primary','title' => 'View']);            
                    }, 

                    'update' => function ($url,$model) {
                        if($model->status == 'new'){
                        return Html::a(            
                            '<span class="glyphicon glyphicon-pencil"></span>',             
                            $url,['class'=>'btn btn-success','title' => 'Update']);            
                        }
                    },      
                    'delete' => function ($url,$model) {
                        if($model->status == 'new'){
                            return Html::a(            
                                '<span class="glyphicon glyphicon-trash"></span>',             
                                $url,['class'=>'btn btn-danger','title' => 'Delete']);            
                        }
                    },         
                ],
            
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
