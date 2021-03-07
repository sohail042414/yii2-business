<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchClient */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',            
            [
                'attribute' => 'city_id',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return $data->getCity()->one()->name; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            'phone',
            'address',
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 150px;'],
                'header'=>'Actions',
                'template' => '{view} {update} {delete}',            
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-pencil"></span>',             
                            $url,['class'=>'btn btn-success','title' => 'Update']);            
                    },     
                    'view' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-eye-open"></span>',             
                            $url,['class'=>'btn btn-primary','title' => 'View']);            
                    },  
                    'delete' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-trash"></span>',             
                            $url,['class'=>'btn btn-danger','title' => 'Delete']);            
                    },         
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
