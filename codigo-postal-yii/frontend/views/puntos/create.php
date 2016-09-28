<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Puntos */

$this->title = 'Create Puntos';
$this->params['breadcrumbs'][] = ['label' => 'Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
