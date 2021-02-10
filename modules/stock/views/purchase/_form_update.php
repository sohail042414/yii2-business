<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Vendor;
use app\models\Item;

use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-12 col-lg-12 col-sm-12"> 
            
            <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>

            <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>

            <?php //$form->field($model, 'total_amount')->textInput() ?>
            <?php //$form->field($model, 'status')->textInput(['maxlength' => true]) ?>

        </div>
        
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <h2>Purchase Items</h2>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?php //= $form->field($purchase_item, 'purchase_id')->hiddenInput() ?>
            <?= $form->field($purchase_item, 'item_id')->dropDownList(ArrayHelper::map(Item::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12"> 
            <?= $form->field($purchase_item, 'quantity')->textInput() ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12">         
            <?= $form->field($purchase_item, 'purchase_price')->textInput() ?>    
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12" style="padding-top:20px;">
            <?= Html::submitButton(Yii::t('app', 'Save & Continue'), ['class' => 'btn btn-primary']) ?>        
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12"> 
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'item_id',
                    'quantity',
                    'purchase_price',
                    'purchase_total',

                    ['class' => 'yii\grid\ActionColumn'],
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

    <?php ActiveForm::end(); ?>

</div>
