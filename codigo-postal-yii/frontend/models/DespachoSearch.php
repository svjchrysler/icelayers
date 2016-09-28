<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Despacho;

/**
 * DespachoSearch represents the model behind the search form about `app\models\Despacho`.
 */
class DespachoSearch extends Despacho
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'repartidor_id', 'pedido_id'], 'integer'],
            [['fecha_despacho'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Despacho::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'repartidor_id' => $this->repartidor_id,
            'pedido_id' => $this->pedido_id,
            'fecha_despacho' => $this->fecha_despacho,
        ]);

        return $dataProvider;
    }
}
