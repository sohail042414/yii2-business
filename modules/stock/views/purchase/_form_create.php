<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vendor;

use app\models\Account;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>
            
    <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'id', 'name'), ['prompt' => 'None']) ?>

    <?php //= $form->field($model, 'account_id')->dropDownList(ArrayHelper::map(Account::findAll(['type'=>'L']), 'id', 'title'), ['prompt' => 'None']) ?>


    <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Next'), ['class' => 'btn btn-success']) ?>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
