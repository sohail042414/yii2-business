<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Vendor;
use app\models\Account;
use app\models\Item;
use app\models\Purchase;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">             
            <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">             
            <?= $form->field($model, 'account_id')->dropDownList(ArrayHelper::map(Account::findAll(['type'=>'L']), 'id', 'title'), ['prompt' => 'None']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>
            <?= Html::submitButton(Yii::t('app', 'Update Info'), ['class' => 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['action' =>['purchase-item/create']]); ?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <h2>Purchase Items</h2>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($purchase_item, 'item_id')->dropDownList(ArrayHelper::map(Item::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($purchase_item, 'quantity')->textInput() ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12">         
            <?= $form->field($purchase_item, 'purchase_price')->textInput() ?>    
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12" style="padding-top:10px;">
            <?= $form->field($purchase_item, 'purchase_id')->hiddenInput()->label(false); ?>
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
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Complete Purchase'), ['class' => 'btn btn-success']) ?>
            </div>    
        </div>
    </div>

    

</div>
