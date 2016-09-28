<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepartidorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repartidores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repartidor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Repartidor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'direccion',
            'telefono',
            'email:email',
            // 'activo',
            // 'departament_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
