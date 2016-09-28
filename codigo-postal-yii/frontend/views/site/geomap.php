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
$this->title = 'GeoMap';
$this->params['breadcrumbs'][] = $this->title;

// $consulta= ArrayHelper::map(app\models\Datos::find()->all(),'IdSecuencial');

?>

  <!-- <head>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <title>Simple GeoJSON Editor</title> -->
    
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCGC7wby6LoJ0UCIMFZd4FYpwO1d6qd3UY"></script>
     <script src="../web/js/editor.js"></script> 
    <link href="../web/css/stylesgeomap.css" title="compact" rel="stylesheet" type="text/css">
    
  <!-- </head> -->

  <!-- <body> -->
    <div id="panel">
      <div id="panel-content">
        <div id="panel-title">Guarda tu GeoJSON</div>
        <hr/>
        <div id="geojson-controls">
          <button onclick="document.getElementById('geojson-input').select();">Select All</button>
          <a id="download-link" href="data:;base64," download="geojson.geojson"><button>Download</button></a>
        </div>
        <textarea id="geojson-input"
            placeholder=""></textarea>
            <!-- placeholder="Arrastra y suelta GeoJSON en el mapa o pegarlo aquí para comenzar a editar."></textarea> -->
      </div>
    </div>

    <div id="map-container">
      <div id="map-holder" style="width:500px; height:500px;></div>

      <div id="drop-container">
        <div id="drop-silhouette"></div>
      </div>
    </div>
