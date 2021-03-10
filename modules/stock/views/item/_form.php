<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Category;
use app\models\Unit;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'category')->textInput() ?>

    <?php //= $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'), ['prompt' => 'Select']) ?>

    <?php 
        echo $form->field($model, 'category')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Category::find()->all(), 'id', 'title'),
            'options' => ['placeholder' => 'Select Category'],
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]);
    ?>

    <?= $form->field($model, 'item_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypesList(), ['prompt' => 'Select Type']) ?>

    <?php //= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'count_unit')->dropDownList(ArrayHelper::map(Unit::getCountUnits(),'symbol', 'name'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?php //= $form->field($model, 'weight_unit')->dropDownList(ArrayHelper::map(Unit::getWeightUnits(),'symbol', 'name'), ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'purchase_price')->textInput() ?>

    <?= $form->field($model, 'sale_price')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
