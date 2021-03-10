<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\Item;

/**
 * This is the model class for table "{{%sale_item}}".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $item_id
 * @property int $quantity
 * @property int $sale_price
 * @property int $sale_total
 * @property int $created_at
 * @property int $updated_at
 */
class SaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sale_item}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'item_id', 'quantity', 'sale_price','type','weight'], 'required'],
            [['sale_id', 'item_id','shortage' ,'weight','quantity', 'sale_price', 'sale_total', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sale_id' => Yii::t('app', 'Sale ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'type' => Yii::t('app', 'Type'),
            'quantity' => Yii::t('app', 'Quantity'),
            'weight' => Yii::t('app', 'Weight(Kg)'),
            'weight_unit' => Yii::t('app', 'Unit'),
            'total_weight' => Yii::t('app', 'Weight(Kg)'),
            'count_unit' => Yii::t('app', 'Unit'),
            'shortage' => Yii::t('app', 'Shortage'),
            'sale_price' => Yii::t('app', 'Rate/Kg'),
            'sale_total' => Yii::t('app', 'Sale Total'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SaleItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SaleItemQuery(get_called_class());
    }

    public function getItem()
    {           
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if($this->type =='wholesale'){
            $this->total_weight = $this->weight;
            $this->sale_total = $this->weight*$this->sale_price;
        }

        if($this->type =='retail'){
            $this->total_weight = $this->weight*$this->quantity;
            $this->sale_total = $this->quantity*$this->sale_price;
        }

        // ...custom code here...
        if(empty($this->shortage)){
            $this->shortage = 0;
        }

        return true;
    }
}
