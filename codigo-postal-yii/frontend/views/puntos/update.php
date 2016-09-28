<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Puntos */

$this->title = 'Update Punto: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puntos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
