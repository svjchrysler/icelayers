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
$this->title = 'Mapa';
$this->params['breadcrumbs'][] = $this->title;

// $consulta= ArrayHelper::map(app\models\Datos::find()->all(),'IdSecuencial');

$codigo=0;
if(isset($_GET['numero'])){
$codigo  = $_GET['numero'];
}else $codigo='851101';



// $consulta= ArrayHelper::map(Datos::find()->where(['IDCLASIFICADOR' => '55101'])->all(),'IdSecuencial','Latitud','barrio');

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

    // $coord = new LatLng(['lat' => -17.750089311812094, 'lng' => -63.17165944519042]);

    // $map = new Map([
    //     'center' => $coord,
    //     'zoom' =>10,
    // ]);



     // for ($i=0; $i < sizeof($data); $i++) { 
     //     $data2=$data[$i];
     //     // echo $data2['IdSecuencial']."\n";
     //     // echo $data2['barrio']."\n";
     //     // echo $data2['Latitud']."\n";
     //     // echo $data2['Longitud']."<br>";
     //    $coord = new LatLng(['lat' => $data2['Longitud'], 'lng' => $data2['Latitud']]);
     //    $marker = new Marker([
     //        'position' => $coord,
     //        'title' => $data2['DescripcionClasificacion'],
     //    ]);
     //    $marker->attachInfoWindow(
     //        new InfoWindow([
     //            'content' => $marker->title,
     //        ])

     //    );
     //    $map->addOverlay($marker);

     //    // Lets show the BicyclingLayer :)
     //    $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
         
     //    // Append its resulting script
     //    $map->appendScript($bikeLayer->getJs());
         
        

     // }
    //  unset($data);
    //  unset($data2);
     
    // // Display the map -finally :)
    //  echo $map->display();

?>






<script type="text/javascript">
  function descargarArchivo(contenidoEnBlob, nombreArchivo) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var save = document.createElement('a');
        save.href = event.target.result;
        save.target = '_blank';
        save.download = 'capaGeoJSON.geojson';
        var clicEvent = new MouseEvent('click', {
            'view': window,
                'bubbles': true,
                'cancelable': true
        });
        save.dispatchEvent(clicEvent);
        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    };
    reader.readAsDataURL(contenidoEnBlob);
};

//Función de ayuda: reúne los datos a exportar en un solo objeto
function obtenerDatos() {
    var texto=[];
    texto.push(document.getElementById('geojson-input').value);
        
        return new Blob(texto, {
        type: 'text/plain'
    });
};

//Función de ayuda: "escapa" las entidades XML necesarias
//para los valores (y atributos) del archivo XML
function escaparXML(cadena) {
    if (typeof cadena !== 'string') {
        return '';
    };
    cadena = cadena.replace('&', '&amp;')
        .replace('<', '&lt;')
        .replace('>', '&gt;')
        .replace('"', '&quot;');
    return cadena;
};

//Genera un objeto Blob con los datos en un archivo TXT
function generarTexto(datos) {
    var texto = [];
    texto.push('Datos Personales:\n');
    texto.push('Nombre: ');
    texto.push(datos.nombre);
    texto.push('\n');
    texto.push('Teléfono: ');
    texto.push(datos.telefono);
    texto.push('\n');
    texto.push('Fecha: ');
    texto.push(datos.fecha);
    texto.push('\n');
    //El contructor de Blob requiere un Array en el primer parámetro
    //así que no es necesario usar toString. el segundo parámetro
    //es el tipo MIME del archivo
    return new Blob(texto, {
        type: 'text/plain'
    });
};


//Genera un objeto Blob con los datos en un archivo XML
function generarXml(datos) {
    var texto = [];
    texto.push('<?xml version="1.0" encoding="UTF-8" ?>\n');
    texto.push('<datos>\n');
    texto.push('\t<nombre>');
    texto.push(escaparXML(datos.nombre));
    texto.push('</nombre>\n');
    texto.push('\t<telefono>');
    texto.push(escaparXML(datos.telefono));
    texto.push('</telefono>\n');
    texto.push('\t<fecha>');
    texto.push(escaparXML(datos.fecha));
    texto.push('</fecha>\n');
    texto.push('</datos>');
    //No olvidemos especificar el tipo MIME correcto :)
    return new Blob(texto, {
        type: 'application/xml'
    });
};

// document.getElementById('boton-xml').addEventListener('click', function () {
//     var datos = obtenerDatos();
//     descargarArchivo(generarXml(datos), 'archivo.xml');
// }, false);

// document.getElementById('boton-txt').addEventListener('click', function () {
//     var datos = obtenerDatos();
//     descargarArchivo(generarTexto(datos), 'archivo.txt');
// }, false);

</script>


<div class="site-about">
    <h1><?= Html::encode($this->title); ?></h1>

    <p>Mapa: </p>

    
</div>

<div id="mapita" style="width:500px; height:500px;"></div>


    <script type="text/javascript">
    var map = document.getElementById('mapita');
function saveData() {
// map = document.getElementById('gmap0-map-canvas');
var datos = map.data;
map.data.setStyle({
  editable: false,
  strokeWeight: 2,
  strokeColor: '#686868',
  });

// map.getGeoJson(function (o){
//   console.log(o)
//  });

 map.data.toGeoJson(function(ob) {

   var jsonData = JSON.stringify(ob);
   document.querySelector('#geojson-input').innerHTML =jsonData;

  });

 descargarArchivo(obtenerDatos(),"prueba.geojson");


}
</script>

<script src="http://ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js"></script>
  

<script type="text/javascript">

    var map;
    var marker;
    var myLatLng={lat:-17.774252, lng: -63.190262};

    function initMap() {
      map = new google.maps.Map(document.getElementById("mapita"), {
        center: myLatLng,
        zoom: 12
      });

      // marker=new google.maps.Marker({
      //   position: myLatLng,
      //   map:map,
      //   title:"Santa Cruz de la Sierra"
      // });

<?php 
      for ($i=0; $i < sizeof($data); $i++) { 
         $data2=$data[$i];
         ?>
                contentString= '<?php echo $data2["NombreRef"]?>';
                var infowindow=new google.maps.InfoWindow({
                  content: contentString
                
                });

                    myLatLng={lat: <?php echo $data2["Longitud"]?>, lng: <?php echo $data2["Latitud"] ?>};

                    marker=new google.maps.Marker({
                      position: myLatLng,
                      map:map,
                      title: '<?php echo $data2["DescripcionClasificacion"]?>'
                    });

                    google.maps.event.addListener(marker,'click',function(){
                      infowindow.setContent(contentString);
                      infowindow.open(map,this);
                    });
                    // marker.addListener('click',function(){
                    //   infowindow.open(map,marker);
                    // });

                    marker.setMap(map);
<?php     } ?>



    }
    </script>

     
   <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGC7wby6LoJ0UCIMFZd4FYpwO1d6qd3UY&callback=initMap">
    </script>
 


<article id="article3" style="">
        <div style="margin: 2px 0px 2px 0px;">
            <button onclick= "saveData()">Save</button>
        </div>
        <textarea id="geojson-input" placeholder="..." class="" style="height: 97%; width: 100%"></textarea>
</article>










<script type="text/javascript">
  // The Google Map.
var map;

// The HTML element that contains the drop container.
var dropContainer;
var panel;
var geoJsonInput;
var downloadLink;

function init() {
  // Initialise the map.
  map = new google.maps.Map(document.getElementById('mapita'), {
    center: {lat: 0, lng: 0},
    zoom: 3
  });
  map.data.setControls(['Point', 'LineString', 'Polygon']);
  map.data.setStyle({
    editable: true,
    draggable: true
  });
  bindDataLayerListeners(map.data);

  // Retrieve HTML elements.
  dropContainer = document.getElementById('drop-container');
  panel = document.getElementById('panel');
  var mapContainer = document.getElementById('map-holder');
  geoJsonInput = document.getElementById('geojson-input');
  downloadLink = document.getElementById('download-link');

  // Resize the geoJsonInput textarea.
  resizeGeoJsonInput();

  // Set up the drag and drop events.
  // First on common events.
  [mapContainer, dropContainer].forEach(function(container) {
    google.maps.event.addDomListener(container, 'drop', handleDrop);
    google.maps.event.addDomListener(container, 'dragover', showPanel);
  });

  // Then map-specific events.
  google.maps.event.addDomListener(mapContainer, 'dragstart', showPanel);
  google.maps.event.addDomListener(mapContainer, 'dragenter', showPanel);

  // Then the overlay specific events (since it only appears once drag starts).
  google.maps.event.addDomListener(dropContainer, 'dragend', hidePanel);
  google.maps.event.addDomListener(dropContainer, 'dragleave', hidePanel);
  // Set up events for changing the geoJson input.
  google.maps.event.addDomListener(
      geoJsonInput,
      'input',
      refreshDataFromGeoJson);
  google.maps.event.addDomListener(
      geoJsonInput,
      'input',
      refreshDownloadLinkFromGeoJson);

  // Set up events for styling.
  google.maps.event.addDomListener(window, 'resize', resizeGeoJsonInput);
}
google.maps.event.addDomListener(window, 'load', init);

// Refresh different components from other components.
function refreshGeoJsonFromData() {
  map.data.toGeoJson(function(geoJson) {
    geoJsonInput.value = JSON.stringify(geoJson, null, 2);
    refreshDownloadLinkFromGeoJson();
  });
}

// Replace the data layer with a new one based on the inputted geoJson.
function refreshDataFromGeoJson() {
  var newData = new google.maps.Data({
    map: map,
    style: map.data.getStyle(),
    controls: ['Point', 'LineString', 'Polygon']
  });
  try {
    var userObject = JSON.parse(geoJsonInput.value);
    var newFeatures = newData.addGeoJson(userObject);
  } catch (error) {
    newData.setMap(null);
    if (geoJsonInput.value !== "") {
      setGeoJsonValidity(false);
    } else {
      setGeoJsonValidity(true);
    }
    return;
  }
  // No error means GeoJSON was valid!
  map.data.setMap(null);
  map.data = newData;
  bindDataLayerListeners(newData);
  setGeoJsonValidity(true);
}

// Refresh download link.
function refreshDownloadLinkFromGeoJson() {
  downloadLink.href = "data:;base64," + btoa(geoJsonInput.value);
}

// Apply listeners to refresh the GeoJson display on a given data layer.
function bindDataLayerListeners(dataLayer) {
  dataLayer.addListener('addfeature', refreshGeoJsonFromData);
  dataLayer.addListener('removefeature', refreshGeoJsonFromData);
  dataLayer.addListener('setgeometry', refreshGeoJsonFromData);
}

// Display the validity of geoJson.
function setGeoJsonValidity(newVal) {
  if (!newVal) {
    geoJsonInput.className = 'invalid';
  } else {
    geoJsonInput.className = '';
  }
}

// Control the drag and drop panel. Adapted from this code sample:
// https://developers.google.com/maps/documentation/javascript/examples/layer-data-dragndrop
function showPanel(e) {
  e.stopPropagation();
  e.preventDefault();
  dropContainer.className = 'visible';
  return false;
}

function hidePanel() {
  dropContainer.className = '';
}

function handleDrop(e) {
  e.preventDefault();
  e.stopPropagation();
  hidePanel();

  var files = e.dataTransfer.files;
  if (files.length) {
    // process file(s) being dropped
    // grab the file data from each file
    for (var i = 0, file; file = files[i]; i++) {
      var reader = new FileReader();
      reader.onload = function(e) {
        map.data.addGeoJson(JSON.parse(e.target.result));
      };
      reader.onerror = function(e) {
        console.error('reading failed');
      };
      reader.readAsText(file);
    }
  } else {
    // process non-file (e.g. text or html) content being dropped
    // grab the plain text version of the data
    var plainText = e.dataTransfer.getData('text/plain');
    if (plainText) {
      map.data.addGeoJson(JSON.parse(plainText));
    }
  };
  // prevent drag event from bubbling further
  return false;
}

// Styling related functions.
function resizeGeoJsonInput() {
  var geoJsonInputRect = geoJsonInput.getBoundingClientRect();
  var panelRect = panel.getBoundingClientRect();
  geoJsonInput.style.height = panelRect.bottom - geoJsonInputRect.top - 8 + "px";
}

</script>



