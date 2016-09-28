<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Puntos;
use yii\helpers\ArrayHelper;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\layers\BicyclingLayer;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Puntos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


 <?php 

    $posts = Puntos::find()->all();
    $data = ArrayHelper::toArray($posts, [ 
        'app\models\Puntos'=>[
            'id',
            'nombre',
            'direccion',
            'lat',
            'lng',
            'tipo',
            'cpostal',
        ],]);

if(sizeof($data)>0){
    $data2=$data[0];
    $coord = new LatLng(['lat' => $data2['lat'], 'lng' => $data2['lng']]);
}else{
    $coord = new LatLng(['lat' => -17.750089311812094, 'lng' => -63.17165944519042]);

}

    $map = new Map([
        'center' => $coord,
        'zoom' =>10,
        'width'=>700,
        'height'=>300,
        'draggable'=>'true',
        'disableDefaultUI'=>'true',

    ]);

    for ($i=0; $i < sizeof($data); $i++) { 
         $data2=$data[$i];
        $coord = new LatLng(['lat' => $data2['lat'], 'lng' => $data2['lng']]);
        $marker = new Marker([
            'position' => $coord,
            'draggable'=>'false',
            'title' => $data2['nombre'],
            'animation'=> 'google.maps.Animation.DROP',
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
     echo $map->display();
    ?>
   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'nombre',
            'direccion',
            //'lat',
            //'lng',
            'tipo',
            'cpostal:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
