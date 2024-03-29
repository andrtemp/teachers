<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sheldule;

/**
 * ShelduleSearch represents the model behind the search form of `app\models\Sheldule`.
 */
class ShelduleSearch extends Sheldule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client', 'coach', 'type_note', 'hall_id', 'done'], 'integer'],
            [['time', 'date', 'note', 'end_time'], 'safe'],
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
        $query = Sheldule::find();

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
            'time' => $this->time,
            'end_time' => $this->end_time,
            'date' => $this->date,
            'client' => $this->client,
            'coach' => $this->coach,
            'type_note' => $this->type_note,
            'hall_id' => $this->hall_id,
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
