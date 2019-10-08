<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Coach;

/**
 * CoachSearch represents the model behind the search form of `app\models\Coach`.
 */
class CoachSearch extends Coach
{
    
    public $personName,$personSecondName,$personPhone;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'tarif'], 'integer'],
            [['note','personName','personSecondName','personPhone'], 'safe'],
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
        $query = Coach::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'person_id' => $this->person_id,
            'tarif' => $this->tarif,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        $query->joinWith(['person' => function ($q) {
            $q->where('person.name LIKE "%' . $this->personName . '%" ');
        }]);
        $query->joinWith(['person' => function ($q) {
            $q->where('person.second_name LIKE "%' . $this->personSecondName . '%" ');
        }]);
        $query->joinWith(['person' => function ($q) {
            $q->where('person.phone LIKE "%' . $this->personPhone . '%" ');
        }]);

        return $dataProvider;
    }
}
