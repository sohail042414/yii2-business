<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%purchase_item}}".
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $item_id
 * @property int $quantity
 * @property int $purchase_price
 * @property int $purchase_total
 * @property int $created_at
 * @property int $updated_at
 */
class PurchaseItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%purchase_item}}';
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
            [['purchase_id', 'item_id', 'quantity', 'purchase_price', 'purchase_total',], 'required'],
            [['purchase_id', 'item_id', 'quantity', 'purchase_price', 'purchase_total', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'purchase_id' => Yii::t('app', 'Purchase ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'purchase_price' => Yii::t('app', 'Purchase Price'),
            'purchase_total' => Yii::t('app', 'Purchase Total'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PurchaseItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PurchaseItemQuery(get_called_class());
    }
}
