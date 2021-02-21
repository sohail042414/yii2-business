<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

use app\models\Client;
use app\models\Account;
use app\models\Item;
use app\models\Sale;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        
        <div class="col-md-6 col-lg-6 col-sm-12">             
            <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map(Client::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12"> 
        <?= $form->field($model, 'bill_no')->textInput() ?>  
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12"> 
        <?= $form->field($model, 'cash_amount')->textInput() ?>  
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12"> 
            <?= $form->field($model, 'bill_date')->widget(DatePicker::classname(), [
                 'options' => ['class' => 'form-control'],
                 'dateFormat' => 'dd-MM-yyyy',
                ]) 
            ?>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12"> 
        <?= $form->field($model, 'debit_amount')->textInput() ?>  
        </div>

  
        <div class="col-md-6 col-lg-6 col-sm-12" style="display:none;">             
            <?php //= $form->field($model, 'account_id')->dropDownList(ArrayHelper::map(Account::findAll(['type'=>'A']), 'id', 'title'), ['prompt' => 'Select']) ?>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>
            <?= Html::submitButton(Yii::t('app', 'Update Info'), ['class' => 'btn btn-primary']) ?>
        </div>  
    </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['action' =>['sale-item/create']]); ?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <h2>Purchase Items</h2>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($sale_item, 'item_id')->dropDownList(ArrayHelper::map(Item::find()->all(), 'id', 'name'), [
                'prompt' => 'Select',
                'onchange'=> ' $.post( "'.Yii::$app->urlManager->createUrl('stock/sale-item/details').'",{id:$(this).val()},function( data ) {
                                $( "#'.Html::getInputId($sale_item, 'weight').'" ).val(data.weight);
                                $( "#'.Html::getInputId($sale_item, 'sale_price').'" ).val(data.sale_price);                   
                            });'
                ]) ?>
        </div>
        <div class="col-md-3 col-lg-2 col-sm-12"> 
            <?= $form->field($sale_item, 'quantity')->textInput() ?>
        </div>
        <div class="col-md-3 col-lg-2 col-sm-12">         
            <?= $form->field($sale_item, 'weight')->textInput() ?>    
        </div>
        <div class="col-md-3 col-lg-2 col-sm-12">         
            <?= $form->field($sale_item, 'sale_price')->textInput() ?>    
        </div>
        <div class="col-md-3 col-lg-2 col-sm-12">         
            <?= $form->field($sale_item, 'shortage')->textInput() ?>    
        </div>
        <div class="col-md-3 col-lg-1 col-sm-12" style="padding-top:10px;">
            <?= $form->field($sale_item, 'sale_id')->hiddenInput()->label(false); ?>
            <?= Html::submitButton(Yii::t('app', 'Add Item'), ['class' => 'btn btn-primary']) ?>        
        </div>
    </div>
    <?php ActiveForm::end(); ?>



    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
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
                    //'quantity',
                    [
                        'attribute' => 'quantity',
                        'footer' => "Total : ".Sale::getTotal($dataProvider->models, 'quantity'),       
                    ],
                    'sale_price',
                    [
                        'attribute' => 'weight',
                        'footer' => "Total : ".Sale::getTotal($dataProvider->models, 'total_weight'),       
                    ],
                    [
                        'attribute' => 'sale_total',
                        'footer' => "Total : ".Sale::getTotal($dataProvider->models, 'sale_total'),       
                    ],
               
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
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Complete Purchase'), ['class' => 'btn btn-success']) ?>
            </div>    
        </div>
    </div>




</div>
