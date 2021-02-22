<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_account".
 *
 * @property int $id
 * @property int $client_id
 * @property int $account_id
 * @property int $default
 */
class ClientAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'account_id'], 'required'],
            [['client_id', 'account_id', 'default'], 'integer'],
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
            'account_id' => Yii::t('app', 'Account ID'),
            'default' => Yii::t('app', 'Default'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClientAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientAccountQuery(get_called_class());
    }
}
