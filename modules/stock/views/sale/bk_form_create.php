<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

use app\models\Client;
use app\models\Account;



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

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
