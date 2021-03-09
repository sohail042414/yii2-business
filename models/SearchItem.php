<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;
use yii\db\Query;

/**
 * SearchItem represents the model behind the search form of `app\models\Item`.
 */
class SearchItem extends Item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category', 'sale_price','purchase_price','created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'safe'],
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
        $query = Item::find();

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
            'category' => $this->category,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            'sale_price' => $this->sale_price,
            'purchase_price' => $this->purchase_price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }


       /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchReport($params)
    {

        $query = (new Query())

                ->select("sale_item.id as sale_item_id , sale.id as sale_id, item.id as item_id, item.name , sale_item.quantity, sale_item.weight ")

                ->from('sale_item')

                ->join('INNER JOIN','sale','sale.id = sale_item.sale_id')

                ->join('INNER JOIN','item','item.id = sale_item.item_id');

                //->groupBy('user.id,user.username,user.created_at');
    
    
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
        /*
        $query->andFilterWhere([
            'id' => $this->id,
            'category' => $this->category,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            'sale_price' => $this->sale_price,
            'purchase_price' => $this->purchase_price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);
        */
        return $dataProvider;
    }
}
