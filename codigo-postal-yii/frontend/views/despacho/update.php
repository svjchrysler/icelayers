<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Despacho */

$this->title = 'Update Despacho: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Despachos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Despacho '.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="despacho-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
