<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trans".
 *
 * @property int $id
 * @property int $journal_id
 * @property int $account_id
 * @property string|null $type
 * @property int $debit
 * @property int $credit
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 */
class Trans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_id', 'account_id', 'debit', 'credit', 'created_at', 'updated_at'], 'required'],
            [['journal_id', 'account_id', 'debit', 'credit', 'created_at', 'updated_at'], 'integer'],
            [['type', 'description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'journal_id' => Yii::t('app', 'Journal ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'type' => Yii::t('app', 'Type'),
            'debit' => Yii::t('app', 'Debit'),
            'credit' => Yii::t('app', 'Credit'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransQuery(get_called_class());
    }
}
