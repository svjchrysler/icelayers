<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Despacho;
use app\models\Repartidor;
use app\models\Pedido;


use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;



/* @var $this yii\web\View */
/* @var $model app\models\Despacho */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despacho-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'repartidor_id')->
	    widget(Select2::classname(), [
		    'data' => \yii\helpers\ArrayHelper::map(Repartidor::find()->all(), 'id', 'nombre'),
		    'language' => 'es',
		    'options' => ['placeholder' => 'Seleccionar Repartidor ...'],
		    'pluginOptions' => [
		        'allowClear' => true
	    ],]);
    ?>

    <?= $form->field($model, 'pedido_id')->
	    widget(Select2::classname(), [
		    'data' => \yii\helpers\ArrayHelper::map(Pedido::find()->all(), 'id','id', 'nombre_persona_destino'),
		    'language' => 'es',
		    'options' => ['placeholder' => 'Seleccionar pedido ...'],
		    'pluginOptions' => [
		        'allowClear' => true
		    ],]);
     ?>
    

    <?= $form->field($model, 'fecha_despacho')->
          // textInput()
            widget(
               DatePicker::className(), [
           // inline too, not bad
               'inline' => false,
               // modify template for custom rendering
               // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
               'language' => 'es',
               'clientOptions' => [
                   'autoclose' => true,
                   // 'format' => 'dd-MM-yyyy'
                   'format' => 'yyyy-mm-dd'
               ]
       ]);
        ?>
  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
