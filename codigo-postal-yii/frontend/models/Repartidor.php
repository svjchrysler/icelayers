<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repartidor".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property integer $activo
 * @property integer $departament_id
 *
 * @property Departamento $departament
 */
class Repartidor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repartidor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'telefono', 'email', 'departament_id'], 'required'],
            [['activo', 'departament_id'], 'integer'],
            [['nombre', 'direccion', 'telefono', 'email'], 'string', 'max' => 50]
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
            'telefono' => 'Telefono',
            'email' => 'Email',
            'activo' => 'Activo',
            'departament_id' => 'Departament ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartament()
    {
        return $this->hasOne(Departamento::className(), ['id' => 'departament_id']);
    }
}
