<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SmsList;

/**
* SmsListSearch represents the model behind the search form about `app\models\SmsList`.
*/
class SmsListSearch extends SmsList
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
        [['id', 'sms_id', 'response_id'], 'integer'],
        [['sms_stamp', 'sms_direction', 'sms_from', 'sms_to', 'sms_text', 'response_stamp'], 'safe'],
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
        $query = SmsList::find();
        
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
        'sms_id' => $this->sms_id,
        'sms_stamp' => $this->sms_stamp,
        'response_id' => $this->response_id,
        'response_stamp'=>$this->response_stamp,
        ]);
        
        $query->andFilterWhere(['like', 'sms_direction', $this->sms_direction])
        ->andFilterWhere(['like', 'sms_from', $this->sms_from])
        ->andFilterWhere(['like', 'sms_to', $this->sms_to])
        ->andFilterWhere(['like', 'sms_text', $this->sms_text]);
        
        return $dataProvider;
    }
}