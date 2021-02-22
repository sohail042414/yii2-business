<?php

namespace app\models;

use Yii;
use app\models\City;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%client}}".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $city
 * @property string $address
 * @property int $created_at
 * @property int $updated_at
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%client}}';
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
            [['name', 'city_id'], 'required'],
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 32],
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
            'city_id' => 'City',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
    }

    public function getCity()
    {           
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function createAccounts(){

        $account = new Account();
        $account->type = 'E';
        $account->parent = 0;
        $account->title = $this->name;
        $account->save();

        $vendor_account = new VendorAccount();
        $vendor_account->account_id = $account->id;
        $vendor_account->default = true;
        $vendor_account->vendor_id;
        $vendor_account->save();

    }
}
