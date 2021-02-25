<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

use app\models\Vendor;
use app\models\Account;
use app\models\City;
use app\models\Item;
use app\models\Purchase;



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
                <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'id', 'name'), [
                    'prompt' => 'Select',
                    'onchange'=> ' $.get( "'.Yii::$app->urlManager->createUrl('vendor/city').'",{id:$(this).val()},function( data ) {
                        $( "#'.Html::getInputId($model, 'vendor_city').'" ).val(data.city_id);
                    });'
                ]) ?>

            </div>

            <div class="col-md-3 col-lg-3 col-sm-12">             
                <?= $form->field($model, 'vendor_city')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
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
            <?= $form->field($model, 'cargo_terminal')->textInput() ?>  
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
            <?= $form->field($purchase_item, 'item_id')->dropDownList(ArrayHelper::map(Item::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
        </div>
        <div class="col-md-2 col-lg-2 col-sm-12"> 
            <?= $form->field($purchase_item, 'quantity')->textInput() ?>
        </div>

        <div class="col-md-2 col-lg-2 col-sm-12"> 
            <?= $form->field($purchase_item, 'weight')->textInput() ?>
        </div>
        
        <div class="col-md-2 col-lg-2 col-sm-12">         
            <?= $form->field($purchase_item, 'purchase_price')->textInput() ?>    
        </div>

        <div class="col-md-2 col-lg-2 col-sm-12">         
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
                        'footer' => "Total : ".Purchase::getTotal($dataProvider->models, 'quantity'),       
                    ],
                    'purchase_price',
                    //'purchase_total',
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