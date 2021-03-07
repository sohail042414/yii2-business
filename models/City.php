<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 */
class City extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'state_id' => Yii::t('app', 'State ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // ...custom code here...
        $this->state_id = 1;
        return true;
    }

    public function getClients()
    {
        return $this->hasMany(Client::className(), ['city_id' => 'id']);
    }

    public function getVendors()
    {
        return $this->hasMany(Vendor::className(), ['city_id' => 'id']);
    }

    public function getCargoTerminals()
    {
        return $this->hasMany(CargoTerminal::className(), ['city_id' => 'id']);
    }

    // public function getSales()
    // {
    //     return $this->hasMany(Sale::className(), ['city_id' => 'id']);
    // }
        
    // public function getPurchase()
    // {
    //     return $this->hasMany(Purchase::className(), ['city_id' => 'id']);
    // }

}
