<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UbicationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubications-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'profession') ?>

    <?= $form->field($model, 'latitute') ?>

    <?= $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'codePostal') ?>

    <?php // echo $form->field($model, 'streetName') ?>

    <?php // echo $form->field($model, 'nameImage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
