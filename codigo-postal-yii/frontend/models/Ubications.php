<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubications".
 *
 * @property integer $id
 * @property string $name
 * @property string $profession
 * @property string $latitute
 * @property string $length
 * @property string $codePostal
 * @property string $streetName
 * @property string $nameImage
 */
class Ubications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'profession', 'latitute', 'length', 'codePostal', 'streetName', 'nameImage'], 'required'],
            [['nameImage'], 'string'],
            [['name', 'profession', 'latitute', 'length', 'codePostal', 'streetName'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'profession' => 'Profession',
            'latitute' => 'Latitude',
            'length' => 'Longitude',
            'codePostal' => 'Code Postal',
            'streetName' => 'Street Name',
            'nameImage' => 'Name Image',
        ];
    }
}
