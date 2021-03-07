<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%payment}}".
 *
 * @property int $id
 * @property int $client_id
 * @property int $amount
 * @property string $payment_method
 * @property string|null $account_no
 * @property string|null $transection
 * @property string|null $notes
 * @property string $payment_date
 * @property int $created_at
 * @property int $updated_at
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payment}}';
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
            [['client_id', 'amount', 'payment_method', 'payment_date',], 'required'],
            [['client_id', 'amount', 'created_at', 'updated_at'], 'integer'],
            [['notes'], 'string'],
            [['payment_date'], 'safe'],
            [['payment_method', 'account_no', 'transection'], 'string', 'max' => 64],
            [['payment_method'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'amount' => Yii::t('app', 'Amount'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'account_no' => Yii::t('app', 'Account No'),
            'transection' => Yii::t('app', 'Transection'),
            'notes' => Yii::t('app', 'Notes'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // ...custom code here...
        $this->payment_date = date('Y-m-d',strtotime($this->payment_date));
        return true;
    }
}
