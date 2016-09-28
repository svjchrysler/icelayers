<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\ArrayHelper;
use app\models\Puntos;

use dosamigos\google\maps\services\DirectionsClient;

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
/* @var $model app\models\Puntos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

?>

 <div class="puntos-view"> 

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'direccion',
            'lat',
            'lng',
            'tipo',
            'cpostal:ntext',
        ],
    ]) ?>


 <?php 

    $coord = new LatLng(['lat' => $model->lat, 'lng' => $model->lng]);

    $map = new Map([
        'center' => $coord,
        'zoom' =>15,
        'width'=>700,
        'height'=>300,
        'draggable'=>'false',
        'disableDefaultUI'=>'true',

    ]);

    // if (isset($_GET["latitude"]) && isset($_GET["longitude"])) {
    //     $home = new LatLng(['lat' => $_GET["latitude"], 'lng' => $_GET["longitude"]]);
    //  $markerHome = new Marker([
    //                 'position' => $home,
    //                 'draggable'=>'false',
    //                 'title' => 'My ubication',
    //                 'animation'=> 'google.maps.Animation.DROP',
    //             ]);

    //     $markerHome->attachInfoWindow(
    //         new InfoWindow([
    //             'content' => $markerHome->title,
                
    //         ])

    //     );
    //     $map->addOverlay($markerHome);

    //     $waypoints = [
    //         new DirectionsWayPoint(['location' => $home])
    //     ];
         
    //     $directionsRequest = new DirectionsRequest([
    //         'origin' => $home,
    //         'destination' => $coord,
    //         'waypoints' => $waypoints,
    //         'travelMode' => TravelMode::DRIVING
    //     ]);
         
    //     // Lets configure the polyline that renders the direction
    //     $polylineOptions = new PolylineOptions([
    //         'strokeColor' => '#FFAA00',
    //         'draggable' => true
    //     ]);
         
    //     // Now the renderer
    //     $directionsRenderer = new DirectionsRenderer([
    //         'map' => $map->getName(),
    //         'polylineOptions' => $polylineOptions
    //     ]);
         
    //     // Finally the directions service
    //     $directionsService = new DirectionsService([
    //         'directionsRenderer' => $directionsRenderer,
    //         'directionsRequest' => $directionsRequest
    //     ]);
         
    //     // Thats it, append the resulting script to the map
    //     $map->appendScript($directionsService->getJs());



    //     $coords = [
    //         $coord,
    //         $home
    //     ];

    //         $polygon = new Polygon([
    //             'paths' => $coords
    //         ]);

    //     //     // Add a shared info window
    //     // $polygon->attachInfoWindow(new InfoWindow([
    //     //         'content' => '<p>This is my super cool Polygon</p>'
    //     //     ]));
         
    //     // $map->addOverlay($polygon);
 

    // } else {
    //     echo "<p>No parameters</p>";
    //     echo '<script type="text/javascript">
    //                 if(navigator.geolocation){
    //                     navigator.geolocation.getCurrentPosition(function (position) {
                              
    //                           window.location.href = window.location.href + "&latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude;
    //                     });
    //                 }
    //            </script>';
    // }

    $lat=$model->lat;
    $lng=$model->lng;

        $marker = new Marker([
            'position' => $coord,
            'draggable'=>'false',
            'title' => $model->nombre .' \n '.$model->cpostal,
            'animation'=> 'google.maps.Animation.DROP',
        ]);
    

        $marker->attachInfoWindow(
            new InfoWindow([
                'content' => $marker->title,
                
            ])

        );

        $map->addOverlay($marker);


         $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
         
        // // Append its resulting script
         $map->appendScript($bikeLayer->getJs());

     echo $map->display();



    ?>





 
   

</div>
