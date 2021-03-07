<?php

namespace app\models;

use Yii;

use app\models\City;

/**
 * This is the model class for table "{{%cargo_terminal}}".
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property string|null $phone
 */
class CargoTerminal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cargo_terminal}}';
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
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'city_id' => Yii::t('app', 'City ID'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CargoTerminalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CargoTerminalQuery(get_called_class());
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
