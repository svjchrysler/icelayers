<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property integer $id
 * @property string $detalle
 * @property string $cod_postal
 * @property string $direccion
 * @property string $nombre_persona_destino
 * @property string $telefono
 * @property integer $status
 *
 * @property Status $status0
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detalle', 'cod_postal', 'direccion', 'nombre_persona_destino', 'telefono', 'status'], 'required'],
            [['status'], 'integer'],
            [['detalle', 'cod_postal', 'nombre_persona_destino'], 'string', 'max' => 200],
            [['direccion', 'telefono'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detalle' => 'Detalle',
            'cod_postal' => 'Cod Postal',
            'direccion' => 'Direccion',
            'nombre_persona_destino' => 'Persona Destinatario',
            'telefono' => 'Telefono',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }
}
