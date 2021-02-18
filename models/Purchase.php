<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use app\models\PurchaseItem;
use app\models\Vendor;

/**
 * This is the model class for table "{{%purchase}}".
 *
 * @property int $id
 * @property int $vendor_id
 * @property string|null $notes
 * @property int $total_amount
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%purchase}}';
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
            [['vendor_id'], 'required'],
            [['vendor_id','account_id', 'total_amount', 'created_at', 'updated_at'], 'integer'],
            [['notes'], 'string'],
            [['status'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vendor_id' => Yii::t('app', 'Supplier'),
            'account_id' => Yii::t('app', 'Account'),
            'notes' => Yii::t('app', 'Notes'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PurchaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PurchaseQuery(get_called_class());
    }

    public function getPurhaseItems()
    {
        return $this->hasMany(PurchaseItem::className(), ['purchase_id' => 'id']);
    }

    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }

    public function calculateTotalAmount(){

        $purchase_items = $this->getPurhaseItems()->all();
                
        $total_amount = 0;

        foreach($purchase_items as $item){
            $total_amount+= $item->purchase_total;
        }

        $this->total_amount = $total_amount;
        $this->update();
    }

    public static function getTotal($provider, $fieldName)
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }

        return $total;
    }
}
