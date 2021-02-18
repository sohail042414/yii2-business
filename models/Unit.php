<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%unit}}".
 *
 * @property int $id
 * @property string|null $type
 * @property string $symbol
 * @property string $name
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%unit}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['symbol', 'name'], 'required'],
            [['symbol'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'symbol' => Yii::t('app', 'Symbol'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitQuery(get_called_class());
    }
}
