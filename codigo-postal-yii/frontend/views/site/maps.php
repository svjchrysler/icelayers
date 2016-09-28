<?php

use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use app\models\Datos;

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
$this->title = 'Maps';
$this->params['breadcrumbs'][] = $this->title;

// $consulta= ArrayHelper::map(app\models\Datos::find()->all(),'IdSecuencial');

?>
<div class="site-about">
    <!-- <h1><?= Html::encode($this->title); ?></h1> -->

    

    
</div>

<?php 
// $consulta= ArrayHelper::map(Datos::find()->where(['IDCLASIFICADOR' => '55101'])->all(),'IdSecuencial','Latitud','barrio');

$codigo=0;
if(isset($_GET['numero'])){
$codigo  = $_GET['numero'];
}else
$codigo='851101';

    $posts = Datos::find()->where(['IDCLASIFICADOR' => $codigo])->all();
    $data = ArrayHelper::toArray($posts, [ 
        'app\models\Datos'=>[
            'IdSecuencial',
            'barrio',
            'Latitud',
            'Longitud',
            'DescripcionClasificacion',
            'NombreRef',

        ],]);
    // $array=ArrayHelper::toArray(Datos::find()->limit(10)->all(),'IdSecuencial','barrio');
    // echo print_r($data,true);



    $coord = new LatLng(['lat' => -17.750089311812094, 'lng' => -63.17165944519042]);

    $map = new Map([
        'center' => $coord,
        'zoom' =>12,
    ]);



     for ($i=0; $i < sizeof($data); $i++) { 
         $data2=$data[$i];
        $coord = new LatLng(['lat' => $data2['Longitud'], 'lng' => $data2['Latitud']]);
        $marker = new Marker([
            'position' => $coord,
            'title' => $data2['NombreRef'],
        ]);
        $marker->attachInfoWindow(
            new InfoWindow([
                'content' => $marker->title,
            ])

        );
        $map->addOverlay($marker);

        // Lets show the BicyclingLayer :)
        $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
         
        // Append its resulting script
        $map->appendScript($bikeLayer->getJs());
         
        

     }
     unset($data);
     unset($data2);
    // Display the map -finally :)
     echo $map->display();

     


?>




<?php
// $coord = new LatLng(['lat' => -17.750089311812094, 'lng' => -63.17165944519042]);
// $map = new Map([
//     'center' => $coord,
//     'zoom' =>10,
// ]);
 
// lets use the directions renderer
// $home = new LatLng(['lat' => -18.720991014764536, 'lng' => -63.911801719665541]);
// $school = new LatLng(['lat' => -18.719456079114956, 'lng' => -63.8979293346405166]);
// $santo_domingo = new LatLng(['lat' => -18.72118906848983, 'lng' => -63.907628202438368]);
 
// setup just one waypoint (Google allows a max of 8)
// $waypoints = [
//     new DirectionsWayPoint(['location' => $santo_domingo])
// ];
 
// $directionsRequest = new DirectionsRequest([
//     'origin' => $home,
//     'destination' => $school,
//     'waypoints' => $waypoints,
//     'travelMode' => TravelMode::DRIVING
// ]);
 
// Lets configure the polyline that renders the direction
// $polylineOptions = new PolylineOptions([
//     'strokeColor' => '#FFAA00',
//     'draggable' => true
// ]);
 
// Now the renderer
// $directionsRenderer = new DirectionsRenderer([
//     'map' => $map->getName(),
//     'polylineOptions' => $polylineOptions
// ]);
 
// Finally the directions service
// $directionsService = new DirectionsService([
//     'directionsRenderer' => $directionsRenderer,
//     'directionsRequest' => $directionsRequest
// ]);
 
// Thats it, append the resulting script to the map
// $map->appendScript($directionsService->getJs());
 
// Lets add a marker now
// $marker = new Marker([
//     'position' => $coord,
//     'title' => 'Santa Cruz de la Sierra',
// ]);
 
// Provide a shared InfoWindow to the marker
// $marker->attachInfoWindow(
//     new InfoWindow([
//         'content' => $marker->title
//     ])
// );
 
// Add marker to the map
// $map->addOverlay($marker);
 
// Now lets write a polygon
// $coords = [
//     new LatLng(['lat' => -17.774252, 'lng' => -63.190262]),
//     new LatLng(['lat' => -17.466465, 'lng' => -63.118292]),
//     new LatLng(['lat' => -17.321384, 'lng' => -63.75737]),
//     new LatLng(['lat' => -17.774252, 'lng' => -63.190262])
// ];
 
// $polygon = new Polygon([
//     'paths' => $coords
// ]);
 
// Add a shared info window
// $polygon->attachInfoWindow(new InfoWindow([
//         'content' => '<p>This is my super cool Polygon</p>'
//     ]));
 
// Add it now to the map
// $map->addOverlay($polygon);
 
 
// // Lets show the BicyclingLayer :)
// $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
 
// // Append its resulting script
// $map->appendScript($bikeLayer->getJs());
 
// // Display the map -finally :)
// echo $map->display();
?>
<!-- 
<script type="text/javascript">
function saveData() {
// var map = new Google.Map();
map = <?php $map ?>;

map.data.setStyle({
  editable: false,
  strokeWeight: 2,
  strokeColor: '#686868',
  });

 map.data.toGeoJson(function(data) {
   // var jsonData = JSON.Stringify(data);
   document.querySelector('#geojson-input').innerHTML =JSON.Stringify(data);

  });

//  $.ajax({
//     method: 'POST',
// url: 'http://www.h..........com/savegeojson.php',
// data: {'data' : jsonData},
// success: function(response){
//              alert( response );
//     },
//     error: function (response) {
//              alert('error'+ response);
//              }
// });
}
</script>
 -->
    <script type="text/javascript">
function saveData() {
// var varjs= document.getElementById('gmap0-map-canvas');
map = document.getElementById('gmap0-map-canvas');
var datos = map.data;
// map.data.setStyle({
//   editable: false,
//   strokeWeight: 2,
//   strokeColor: '#686868',
//   });

 map.data.toGeoJson(function(data) {
   // var jsonData = JSON.Stringify(data);
   document.querySelector('#geojson-input').innerHTML =JSON.Stringify(data);

  });

//  $.ajax({
//     method: 'POST',
// url: 'http://www.h..........com/savegeojson.php',
// data: {'data' : jsonData},
// success: function(response){
//              alert( response );
//     },
//     error: function (response) {
//              alert('error'+ response);
//              }
// });
}
</script>
<!-- <article id="article3" style="">
        <div style="margin: 2px 0px 2px 0px;">
            <button onclick= "saveData()">Save</button>
        </div>
        <textarea id="geojson-input" placeholder="..." class="" style="height: 97%; width: 100%"></textarea>
</article> -->


