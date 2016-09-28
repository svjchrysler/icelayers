<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Event;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\layers\BicyclingLayer;

/* @var $this yii\web\View */
/* @var $model app\models\Ubications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubications-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php 
        // if($model->id==0){
            $draggable='true';
        // }else{
        //     $draggable='false';
        // }
            $lat=$model->latitute;
            $lng=$model->length;

        
        // if ($model->id == 0 && isset($_GET["latitude"]) && isset($_GET["longitude"])) {
        //     $lat=$_GET["latitude"];
        //     $lng=$_GET["longitude"];
        // } else {
        //     if($lat == 0 && $lng==0){
        //     // echo '<script type="text/javascript">
        //     //             if(navigator.geolocation){
        //     //                 navigator.geolocation.getCurrentPosition(function (position) {
        //     //                       window.location.href = window.location.href + "&latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude;
        //     //                 });
        //     //             }
        //     //        </script>';
        //        }
        // }
        
        if($lat!=0)
        // {
            $coord = new LatLng(['lat' => $lat, 'lng' => $lng]);
        else
            $coord = new LatLng(['lat' => -17.783111141062967, 'lng' =>-63.18213078919416]);

             $map = new Map([
                'center' => $coord,
                'zoom' =>15,
                'width'=>700,
                'height'=>300,
                'draggable'=> $draggable,
                'disableDefaultUI'=>'true',
                'zoomControl'=>'false',

            ]);

                $marker = new Marker([
                    'position' => $coord,
                    'draggable'=>$draggable,
                    'title' => $model->name .' \n '.$model->codePostal,
                    'animation'=> 'google.maps.Animation.DROP',
                ]);

                $event = new Event(["trigger"=>"dragend",
                "js"=>"
                    document.getElementById('"."ubications-latitute').value=event.latLng.lat();
                    document.getElementById('ubications-length').value=event.latLng.lng();
                        "]);

            $marker->addEvent($event);


                $map->addOverlay($marker);

                // // Lets show the BicyclingLayer :)
                 $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
                 
                // // Append its resulting script
                 $map->appendScript($bikeLayer->getJs());

             echo $map->display();
        // }
       
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codePostal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'streetName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nameImage')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
