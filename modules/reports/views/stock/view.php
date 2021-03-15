<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1>Stock Report Details for Item (<?= Html::encode($this->title) ?>)</h1>

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
        <div class="col-sm-6 col-md-6 col-lg-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',                
                [
                    'attribute' => 'category',
                    'value' => $model->getCategory()->one()->title,     
                ],
                'name',
                'type',
            ],
        ]) ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [ 
                'item_no',
                'weight',
                [
                    'label' => 'Available ',
                    'value' => function ($data) {
                        return $data->getAvailable(); // $data['name'] for array data, e.g. using SqlDataProvider.
                    },   
                ],
                //'purchase_price',
                //'sale_price',
            ],
        ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'item_id',
                'name',
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
            ],
        ]); ?>
        </div>
    </div>

</div>
