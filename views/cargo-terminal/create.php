<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CargoTerminal */

$this->title = Yii::t('app', 'Create Cargo Terminal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cargo Terminals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargo-terminal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
