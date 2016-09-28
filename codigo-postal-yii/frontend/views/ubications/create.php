<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ubications */

$this->title = 'Create Ubications';
$this->params['breadcrumbs'][] = ['label' => 'Ubications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
