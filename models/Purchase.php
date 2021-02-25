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

    public $net_total = 0;

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
            [['vendor_id','vendor_city','bill_date','bill_no','cash_amount'], 'required'],
            [['vendor_id','account_id','vendor_city','bill_book_no','bill_no','total_amount','cash_amount','credit_amount','previous_balance','labour_charges','other_charges','builty_charges','created_at', 'updated_at'], 'integer'],
            [['notes','cargo_terminal','vehicle_no','builty_no','vehicle_no'], 'string'],
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
            'vendor_city' => Yii::t('app', 'City'),
            'notes' => Yii::t('app', 'Notes'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'bill_book_no'  => Yii::t('app', 'Bill Book No'),
            'cargo_terminal' => Yii::t('app', 'Builty Adda (Cargo Terminal)'),
            'builty_no' => Yii::t('app', 'Builty No'),
            'vehicle_no' => Yii::t('app', 'Vehicle (Truck) No'),
            'builty_charges' => Yii::t('app', 'Builty Charges'),
            'other_charges' => Yii::t('app', 'Other Charges'),
            'labour_charges' => Yii::t('app', 'Labour (Adda) Charges'),
            'previous_balance'=> Yii::t('app', 'Previous Balance'),
            'bill_no' => Yii::t('app', 'Bill No'),
            'net_total' => Yii::t('app', 'Net Total'),
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // ...custom code here...
        $this->bill_date = date('Y-m-d',strtotime($this->bill_date));
        return true;
    }

    public function beforeDelete(){

        foreach($this->getPurhaseItems()->all() as $item){
            $item->delete();
        }

        return parent::beforeDelete();
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

    public function getNetTotal(){
        $total =  (int)$this->total_amount+(int)$this->labour_charges+(int)$this->builty_charges+(int)$this->other_charges+(int)$this->previous_balance;
        $this->net_total = (int)$total-(int)$this->discount;
        return $this->net_total;
    }
}
