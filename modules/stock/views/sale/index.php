<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchSale */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bills/Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bill/Sale'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'bill_no',
            'bill_book_no',         
            [
                'attribute' => 'client_id',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return $data->getClient()->one()->name; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            'total_amount',
            'status',
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',  
                'headerOptions' => ['style' => 'width: 150px;'],
                'header'=>'Actions',          
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-eye-open"></span>',             
                            $url,['class'=>'btn btn-primary','title'=>'View']);            
                    }, 
                    'update' => function ($url,$model) {
                        if($model->status == 'new'){
                            return Html::a(            
                                '<span class="glyphicon glyphicon-pencil"></span>',             
                                $url,['class'=>'btn btn-success','title'=>'Update']);            
                        }
                    },      
                    'delete' => function ($url,$model) {
                        if($model->status == 'new'){
                            return Html::a(            
                                '<span class="glyphicon glyphicon-trash"></span>',             
                                $url,['class'=>'btn btn-danger','title'=>'Delete']);            
                        }
                    },         
                ],
            
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
