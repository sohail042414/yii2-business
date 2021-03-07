<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;

use app\models\Client;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'client_id')->textInput() ?>

    <?php 
        echo $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Client::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Select Customer'],
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]);
    ?>

    <?= $form->field($model, 'amount')->textInput() ?>
    
    <?= $form->field($model, 'payment_method')->dropDownList([ 'cash' => 'Cash', 'bank' => 'Bank', 'easypaisa' => 'Easypaisa', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transection')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'payment_date')->widget(DatePicker::classname(), [
                'options' => [
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                ],
                'dateFormat' => 'dd-MM-yyyy',
                ]) 
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
