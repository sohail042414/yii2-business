<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendor_account".
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $account_id
 * @property int $default
 */
class VendorAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id', 'vendor_id'], 'required'],
            [['vendor_id', 'vendor_id', 'default'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'default' => Yii::t('app', 'Default'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VendorAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VendorAccountQuery(get_called_class());
    }
}
