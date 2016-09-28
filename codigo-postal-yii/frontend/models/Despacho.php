<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "despacho".
 *
 * @property integer $id
 * @property integer $repartidor_id
 * @property integer $pedido_id
 * @property string $fecha_despacho
 */
class Despacho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'despacho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repartidor_id', 'pedido_id', 'fecha_despacho'], 'required'],
            [['repartidor_id', 'pedido_id'], 'integer'],
            [['fecha_despacho'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'repartidor_id' => 'Repartidor ID',
            'pedido_id' => 'Pedido ID',
            'fecha_despacho' => 'Fecha Despacho',
        ];
    }
}
