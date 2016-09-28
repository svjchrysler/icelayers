<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Departamento;

use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Repartidor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repartidor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->dropDownList( ['1'=>'ACTIVO','0'=>'INACTIVO'],['prompt' => 'Seleccione un estado']); ?>

    <?= $form->field($model, 'departament_id')->widget(Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(Departamento::find()->all(), 'id', 'nombre'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione el Departamento ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
