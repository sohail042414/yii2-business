<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sale}}".
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $notes
 * @property int $total_amount
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sale}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'created_at', 'updated_at'], 'required'],
            [['client_id', 'total_amount', 'created_at', 'updated_at'], 'integer'],
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
            'client_id' => Yii::t('app', 'Client ID'),
            'notes' => Yii::t('app', 'Notes'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SaleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SaleQuery(get_called_class());
    }
}
