<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%vendor}}".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $city
 * @property string $address
 * @property int $created_at
 * @property int $updated_at
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vendor}}';
    }
    /**
     * 
     */

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
            [['name', 'phone', 'city', 'address'], 'required'],
            //[['created_at', 'updated_at'], 'integer'],
            [['name', 'city'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 16],
            [['address'], 'string', 'max' => 96],
            [['name'], 'unique'],
            [['phone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'city' => 'City',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return VendorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VendorQuery(get_called_class());
    }
}
