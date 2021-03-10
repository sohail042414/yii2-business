<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

use kartik\select2\Select2;

use app\models\Vendor;
use app\models\Account;
use app\models\City;
use app\models\Item;
use app\models\Purchase;
use app\models\CargoTerminal;



$this->registerJs(
    "$(document).ready(function(){
        $('#".Html::getInputId($model, 'vendor_id')."').select2('open');
    });",
);
/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">
    <?php $form = ActiveForm::begin(['enableClientValidation'=> false]); ?>
    
    <div class="row">

        <?php if(!$model->isNewRecord){ ?>
            <?= $form->field($purchase_item, 'purchase_id')->hiddenInput()->label(false); ?>
        <?php } ?>

            <div class="col-md-3 col-lg-3 col-sm-12">             
                <?php 
                // echo $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'id', 'name'), [
                //     'prompt' => 'Select',
                //     'onchange'=> ' $.get( "'.Yii::$app->urlManager->createUrl('vendor/city').'",{id:$(this).val()},function( data ) {
                //         $( "#'.Html::getInputId($model, 'vendor_city').'" ).val(data.city_id);
                //     });'
                // ]); 
                ?>

                <?php 
                echo $form->field($model, 'vendor_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Vendor::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Customer'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'pluginEvents' => [
                        'select2:select'=> ' function() { $.get( "'.Yii::$app->urlManager->createUrl('vendor/city').'",{id:$(this).val()},function( data ) {
                            $( "#'.Html::getInputId($model, 'vendor_city').'" ).val(data.city_id);
                            $( "#'.Html::getInputId($model, 'vendor_city').'" ).trigger("change");
                        }); }'
                    ]
                ]);
                ?>

            </div>

            <div class="col-md-3 col-lg-3 col-sm-12">             
                <?php  //= $form->field($model, 'vendor_city')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
            
                <?php 
                echo $form->field($model, 'vendor_city')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select City'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]);
                ?>
            </div>

            <div class="col-md-3 col-lg-3 col-sm-12"> 
                <?= $form->field($model, 'bill_book_no')->textInput() ?>  
            </div>

            <div class="col-md-3 col-lg-3 col-sm-12"> 
                <?= $form->field($model, 'bill_no')->textInput() ?>  
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'bill_date')->widget(DatePicker::classname(), [
                'options' => [
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                ],
                'dateFormat' => 'dd-MM-yyyy',
                ]) 
            ?>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?php //= $form->field($model, 'cargo_terminal')->textInput() ?>  
            <?php 
                echo $form->field($model, 'cargo_terminal')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(CargoTerminal::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Item'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]);
            ?>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'builty_no')->textInput() ?>  
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'vehicle_no')->textInput() ?>  
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <h2>Items</h2>
        </div>
        
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?php /* $form->field($purchase_item, 'item_id')->dropDownList(ArrayHelper::map(Item::find()->all(), 'id', 'name'), ['prompt' => 'Select']) */ ?>
            <?php 
                echo $form->field($purchase_item, 'item_id')->widget(Select2::classname(), [
                    //'data' => ArrayHelper::map(Item::find()->all(), 'id', 'name'),
                    'data' => Item::getDropdownList(),
                    'options' => ['placeholder' => 'Select Item'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],                    
                    'pluginEvents' => [
                        'select2:select'=> ' function() { $.get( "'.Yii::$app->urlManager->createUrl('stock/sale-item/details').'",{id:$(this).val()},function( data ) {
                            $( "#'.Html::getInputId($purchase_item, 'weight').'" ).val(data.weight);
                            $( "#'.Html::getInputId($purchase_item, 'type').'" ).val(data.type);
                            $( "#'.Html::getInputId($purchase_item, 'purchase_price').'" ).val(data.purchase_price);   
                        }); }'
                    ]
                ]);
            ?>
        </div>
        
        <div class="col-md-2 col-lg-2 col-sm-12">         
            <?= $form->field($purchase_item, 'type')->dropDownList(Item::getTypesList(), ['prompt' => 'Select Type']) ?>
        </div>

        <div class="col-md-1 col-lg-1 col-sm-12"> 
            <?= $form->field($purchase_item, 'quantity')->textInput() ?>
        </div>

        <div class="col-md-2 col-lg-2 col-sm-12"> 
            <?= $form->field($purchase_item, 'weight')->textInput() ?>
        </div>
        
        <div class="col-md-2 col-lg-2 col-sm-12">         
            <?= $form->field($purchase_item, 'purchase_price')->textInput() ?>    
        </div>

        <div class="col-md-1 col-lg-1 col-sm-12">         
            <?= $form->field($purchase_item, 'shortage')->textInput() ?>    
        </div>

        <div class="col-md-3 col-lg-1 col-sm-12" style="padding-top:24px;">            
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>        
        </div>

    </div>


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
                        'label' => 'Item No',
                        'attribute' => 'item_no',
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
                    'type',
                    [
                        'attribute' => 'quantity',
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'quantity'),       
                    ],
                    [
                        'attribute' => 'total_weight',
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'total_weight'),       
                    ],
                    'purchase_price',
                    [
                        'attribute' => 'purchase_total',
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'purchase_total'),       
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
        
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'builty_charges')->textInput() ?>  
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'labour_charges')->textInput() ?>  
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'other_charges')->textInput() ?>  
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'previous_balance')->textInput() ?>  
        </div>

    </div>

    <div class="row">

        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'total_amount')->textInput() ?>  
        </div> 

        <div class="col-md-2 col-lg-2 col-sm-12"> 
            <?= $form->field($model, 'cash_amount')->textInput() ?>  
        </div>

        <div class="col-md-2 col-lg-2 col-sm-12"> 
            <?= $form->field($model, 'credit_amount')->textInput() ?>  
        </div>  

        <div class="col-md-2 col-lg-2 col-sm-12"> 
            <?= $form->field($model, 'discount')->textInput() ?>  
        </div>  

        <div class="col-md-2 col-lg-3 col-sm-12"> 
            <?= $form->field($model, 'net_total')->textInput() ?>  
        </div>  

    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Complete Purchase'), ['class' => 'btn btn-success']) ?>
            </div>    
        </div>
    </div>

    <?php ActiveForm::end(); ?>    

</div>
