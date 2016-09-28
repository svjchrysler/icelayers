<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Status;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'detalle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_postal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_persona_destino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(Status::find()->all(), 'id', 'nombre'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione el Estado ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
