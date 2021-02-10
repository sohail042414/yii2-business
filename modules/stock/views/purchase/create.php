<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */

$this->title = Yii::t('app', 'Create Purchase');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
    ]) ?>

</div>
