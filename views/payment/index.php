<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Receive Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'amount',
            'payment_method',
            'account_no',
            //'transection',
            //'notes:ntext',
            //'payment_date',
            //'created_at',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',  
                'headerOptions' => ['style' => 'width: 150px;'],
                'header'=>'Actions',          
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-pencil"></span>',             
                            $url,['class'=>'btn btn-success','title'=>'Update']);            
                    },     
                    'view' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-eye-open"></span>',             
                            $url,['class'=>'btn btn-primary','title'=>'View']);            
                    },  
                    'delete' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-trash"></span>',             
                            $url,['class'=>'btn btn-danger','title'=>'Delete']);            
                    },         
                ],
            
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
