<?php

use yii\helpers\Html;
use yii\grid\GridView;



use app\models\Ubications;
use app\models\Pedido;

use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\db\Query;
// use yii\helpers\HtmlPurifier;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\Event;
use dosamigos\google\maps\layers\BicyclingLayer;



/* @var $this yii\web\View */
/* @var $searchModel app\models\UbicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ubications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubications-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ubications', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

     <?php 

        $posts = Ubications::find()->all();
        $data = ArrayHelper::toArray($posts, [ 
            'app\models\Ubications'=>[
                'id',
            'name',
            'profession',
            'latitute',
            'length',
             'codePostal',
             'streetName',
            'nameImage',
            ],]);

        if(sizeof($data)>0){
            $data2=$data[0];
            $coord = new LatLng(['lat' => $data2['latitute'], 'lng' => $data2['length']]);
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
            $coord = new LatLng(['lat' => $data2['latitute'], 'lng' => $data2['length']]);
            $marker = new Marker([
                'position' => $coord,
                'draggable'=>'false',
                'title' => $data2['codePostal'],
                'animation'=> 'google.maps.Animation.DROP',
            ]);
            $marker->attachInfoWindow(
                new InfoWindow([
                    'content' => $marker->title,
                ])
            );

            $event = new Event(["trigger"=>"click",
                "js"=>"
                    // document.getElementById('"."ubications-latitute').value=event.latLng.lat();
                    // document.getElementById('ubications-length').value=event.latLng.lng();
                    // document.getElementById('w1').remove();
                    
                    // var ejecutar='<?= buscar(\''+ this.title +'\') ?>';
                    // <?=  buscar('BO-456123'); ?>
                    // alert(ejecutar);
                    // document.write(ejecutar);
                        window.location.href = window.location.href + '&code_postal=' + this.title;

                    "]);
                    
            $marker->addEvent($event);
            $map->addOverlay($marker);
            $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);
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
            'name',
            'profession',
            //'latitute',
            // 'length',
             'codePostal',
             'streetName',
            // 'nameImage:ntext',

            ['class' => 'yii\grid\ActionColumn'],
            
        ],
    ]); ?>

   

    <?php
        function buscar($codePostal){

        $query = Pedido::find();

        $dataProvider2 = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->
            andFilterWhere(['like', 'cod_postal', $codePostal]);


        //     $dataProvider2 = new ActiveDataProvider([
        //     'query' => Pedido::_search('cod_postal=BO-456123'),
        //     'pagination' => [
        //         'pageSize' => 5,
        //     ],
        // ]); 

// echo GridView::widget([
//     'dataProvider' => $dataProvider,
// ]);

         echo GridView::widget([
            'dataProvider' =>$dataProvider2,
            // 'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                'id',
                'detalle',
                'cod_postal',
                'direccion',
                'nombre_persona_destino',
                'telefono',
                'status',
                ['class' => 'yii\grid\CheckboxColumn'],
            ],
        ]);

        }

        if (isset($_GET["code_postal"])) {
            buscar($_GET["code_postal"]);
        }
        
    ?>

     

</div>
