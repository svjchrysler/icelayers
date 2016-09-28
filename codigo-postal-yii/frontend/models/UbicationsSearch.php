<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ubications;

/**
 * UbicationsSearch represents the model behind the search form about `app\models\Ubications`.
 */
class UbicationsSearch extends Ubications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'profession', 'latitute', 'length', 'codePostal', 'streetName', 'nameImage'], 'safe'],
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
        $query = Ubications::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'latitute', $this->latitute])
            ->andFilterWhere(['like', 'length', $this->length])
            ->andFilterWhere(['like', 'codePostal', $this->codePostal])
            ->andFilterWhere(['like', 'streetName', $this->streetName])
            ->andFilterWhere(['like', 'nameImage', $this->nameImage]);

        return $dataProvider;
    }
}
