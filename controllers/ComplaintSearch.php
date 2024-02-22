<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Complaint;

/**
 * ComplaintSearch represents the model behind the search form of `app\models\Complaint`.
 */
class ComplaintSearch extends Complaint
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_status'], 'integer'],
            [['car_number', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Complaint::find();

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
            'id_user' => $this->id_user,
            'id_status' => $this->id_status,
        ]);

        $query->andFilterWhere(['like', 'car_number', $this->car_number])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
