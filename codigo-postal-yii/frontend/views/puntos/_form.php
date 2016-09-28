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
/* @var $model app\models\Puntos */
/* @var $form yii\widgets\ActiveForm */
?>


<?php

?>


<div class="puntos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    if($model->id==0){
        $draggable='true';
    }else{
        $draggable='true';
    }
        $lat=$model->lat;
        $lng=$model->lng;

    
    if ($model->id == 0 && isset($_GET["latitude"]) && isset($_GET["longitude"])) {
        $lat=$_GET["latitude"];
        $lng=$_GET["longitude"];
    } else {
        if($lat == 0 && $lng==0){
        echo '<script type="text/javascript">
                    if(navigator.geolocation){
                        navigator.geolocation.getCurrentPosition(function (position) {
                              window.location.href = window.location.href + "&latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude;
                        });
                    }
               </script>';
           }
    }
    
    if($lat!=0){
        $coord = new LatLng(['lat' => $lat, 'lng' => $lng]);

         $map = new Map([
            'center' => $coord,
            'zoom' =>15,
            'width'=>700,
            'height'=>300,
            'draggable'=>'false',
            'disableDefaultUI'=>'true',
            'zoomControl'=>'false',

        ]);

            $marker = new Marker([
                'position' => $coord,
                'draggable'=>$draggable,
                'title' => $model->nombre .' \n '.$model->cpostal,
                'animation'=> 'google.maps.Animation.DROP',
            ]);

            // $marker->attachInfoWindow(
            //     new InfoWindow([
            //         'content' => $marker->title,
            //     ])
            // );


         // $event = new Event(["trigger"=>"click",
         //    "js"=>"alert(event.latLng);
         //     "]);
         // $marker->addEvent($event);

            $event = new Event(["trigger"=>"dragend",
                "js"=>"
                    document.getElementById('"."puntos-lat').value=event.latLng.lat();
                    document.getElementById('puntos-lng').value=event.latLng.lng();
                        "]);

            $marker->addEvent($event);

            $map->addOverlay($marker);

            // // Lets show the BicyclingLayer :)
             $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
             
            // // Append its resulting script
             $map->appendScript($bikeLayer->getJs());

         echo $map->display();
    }
   
    ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpostal')->textInput()
    //textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
