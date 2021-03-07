<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\City;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => 'Select']) ?>

    <?php 
        echo $form->field($model, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Select City'],
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]);
    ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php /* ?>
    <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>
    <?php */ ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
