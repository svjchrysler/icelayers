<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// use yii\helpers\Json;
// use yii\helpers\ArrayHelper;
use app\models\Ubications;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/* @var $this yii\web\View */
/* @var $model app\models\Ubications */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ubications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubications-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'profession',
            'latitute',
            'length',
            'codePostal',
            'streetName',
            'nameImage:ntext',
        ],
    ]) ?>



<?php 

    $coord = new LatLng(['lat' => $model->latitute, 'lng' => $model->length]);

    $map = new Map([
        'center' => $coord,
        'zoom' =>15,
        'width'=>700,
        'height'=>300,
        'draggable'=>'true',
        'disableDefaultUI'=>'true',
    ]);

    $lat=$model->latitute;
    $lng=$model->length;
    $marker = new Marker([
            'position' => $coord,
            'draggable'=>'false',
            'title' => $model->name .' \n '.$model->codePostal,
            'animation'=> 'google.maps.Animation.DROP',
        ]);
    

        $marker->attachInfoWindow(
            new InfoWindow([
                'content' => $marker->title,
            ])

        );

        $map->addOverlay($marker);

         $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
         
         $map->appendScript($bikeLayer->getJs());

     echo $map->display();



    ?>

</div>
