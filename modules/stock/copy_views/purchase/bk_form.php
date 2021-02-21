<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Vendor;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'id', 'name'), ['prompt' => 'None']) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
