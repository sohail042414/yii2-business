<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchItem */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'item_no',
            'name',
            [
                'attribute' => 'category',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return $data->getCategory()->one()->title; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            'type',
            [
                'attribute' => 'weight',
                'header'=> 'Available(KG)',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return $data->getAvailable(); // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            [
                'attribute' => 'weight',
                'header'=> 'Available(Mann)',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    return number_format(($data->getAvailable()/40),2,'.',','); // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 150px;'],
                'header'=>'Actions',
                'template' => '{view}',            
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(            
                            '<span class="glyphicon glyphicon-eye-open"></span>',             
                            $url,['class'=>'btn btn-primary','title' => 'View']);            
                    }
                ],
            
            ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
