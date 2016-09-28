<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puntos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $direccion
 * @property double $lat
 * @property double $lng
 * @property string $tipo
 * @property string $cpostal
 */
class Puntos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puntos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'lat', 'lng', 'tipo', 'cpostal'], 'required'],
            [['lat', 'lng'], 'number'],
            [['cpostal'], 'string'],
            [['nombre'], 'string', 'max' => 60],
            [['direccion'], 'string', 'max' => 80],
            [['tipo'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'lat' => 'Latitud',
            'lng' => 'Longitud',
            'tipo' => 'Tipo',
            'cpostal' => 'Cod. Postal',
        ];
    }
}
